<?php

/**
 * This function registers a new post type called "chantier" and sets some default arguments for it
 */
function beny_register_post_types()
{

    // CPT Chantier
    $labels = array(
        'name' => 'Chantiers',
        'all_items' => 'Tous les projets',  // affiché dans le sous menu
        'singular_name' => 'Projet',
        'add_new_item' => 'Ajouter un projet',
        'edit_item' => 'Modifier le projet',
        'new_item' => 'Nouveau projet',
        'edit_item' => 'Modifier le projet',
        'view_item' => 'Voir le projet',
        'search_items' => 'Rechercher parmi les projets',
        'not_found' => 'Pas de projet trouvé',
        'not_found_in_trash' => 'Pas de projet dans la corbeille',
        'menu_name' => 'Chantiers'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 6,
        'menu_icon' => 'dashicons-admin-customizer',
    );

    register_post_type('chantier', $args);

  

}
add_action('init', 'beny_register_post_types');

//Ajouter des champs pour un chantier

class Beny_metabox
{
    private $id;
    private $title;
    private $post_type;
    public $fields = [];
    public function __construct($id, $title, $post_type)
    {
        add_action('add_meta_boxes', array(&$this, 'create'));
        add_action('save_post', array(&$this, 'save'));
        $this->id =$id;
        $this->title =$title;
        $this->post_type =$post_type;
    }
    public function create(){
        if(function_exists('add_meta_box')){
            add_meta_box($this->id, $this->title, array(&$this, 'render'), $this->post_type);
        }
    }
    public function save($post_id){
       // On vérifie si on n'enregistre pas un chantier
        if
           
            (!isset($_POST['post_type']) || $_POST['post_type'] !== 'chantier')
            {
                return;
            }
        //on vérifie les permission
        if(!current_user_can('edit_post', $post_id)){
            return false;
        }
        // on sauvgarde les champs
        foreach($this->fields as $field ){
            $meta = $field['id'];
            if(isset($_POST[$meta]) && !empty($_POST[$meta])){
                $value =sanitize_text_field($_POST[$meta]);
                update_post_meta($post_id, $meta, $value);
            
            }
        }
    }
    public function render(){
        global $post;
        foreach($this->fields as $field ){
            extract($field);
            $value = get_post_meta($post->ID, $id, true);
            if ($value == ''){
                $value = $default;
            }
            require __DIR__ . '/' .$field['type'] . '.php'; 
        }

    }
    public function add($id, $label, $type= 'text', $default =''){
        $this->fields[] =[
            'id' =>$id,
            'name' => $label,
            'type' => $type,
            'default' => $default
        ];
        return $this;

    }
}
$box = new Beny_metabox('chantier_champs', 'Descriptif chantier', 'chantier');
$box->add('common', 'Commune : ', 'text')->add('department', 'Département: ', 'text')->add('works', 'Travaux réalisés : ', 'textarea');
