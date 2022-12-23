<?php
if (!class_exists("WP_List_Table")) {
    require_once(ABSPATH . "wp-admin/includes/class-wp-list-table.php");
}
class DBTableOrder extends WP_List_Table {

    private $_items;
    function __construct($data) {
        parent:: __construct();
        $this->_items = $data;
    }

    function get_columns(){
        return [
            // 'cb'=> '<input type="checkbox">',
            'ID'=> __('Order No.', 'database-demo'),
            'post_date'=> __('Order Date', 'database-demo'),
            'post_title'=> __('Received type', 'database-demo'),
            'action'=> __('Action', 'database-demo'),
        ];
    }
    
    // function column_cb($item) {
    //     return "<input type='checkbox' value='{$item['ID']}'>";
    // }

    // edit & delete option beside check box
    function column_ID($item){
        
        $nonce = wp_create_nonce("dbdemo_edit");

        $actions = [
            'delete' => sprintf('<a href="?page=dbdemo&pid=%s&n=%s&action=%s">%s</a>', $item['ID'], $nonce, 'delete', __('Delete', 'database-demo')),
        ];
        // if($_REQUEST['delete']){
        // die('Okdd');

            // global $wpdb;
            // $table = $wpdb->prefix.'posts';
            // $wpdb->delete( $table, array( 'ID' => $_REQUEST['pid'] ) );
        // }

        return sprintf('%s %s', $item['ID'], $this->row_actions($actions));
    }

    function column_action($item) {
       // $nonce = wp_create_nonce("dbdemo_edit");

      //  $link = wp_nonce_url(admin_url('?page=dbdemo&action=delete&pid=').$item['ID'], "dbdemo_edit", "n"); 
        // return ' <button type="button" onclick="details('.$item['ID'].')" class="Click-here">Details</button> <a href="'.esc_url($link).'">Delete</a>' ; 
        return '<button type="button" onclick="details('.$item['ID'].')" class="Click-here bg-btn">Details</button>' ; 
        
    }

    function column_post_title($item) {
        $contents = $item['post_content'];

        $datas = json_decode($contents,true); 
            echo $datas['delivery'];

    }

    function column_default($item, $column_name) {
        return $item[$column_name];
    }

    function prepare_items() {
        // $query->query_vars['posts_per_page'] = 8;
        $per_page = 4;
        $current_page = $this->get_pagenum();
        $total_items = count($this->_items);
        $this->set_pagination_args([
            'total_items'=>$total_items,
            'per_page'=>$per_page,
        ]);
        $data = array_slice($this->_items, ($current_page-1)*$per_page,$per_page);
        $this->items = $data;
        $this->_column_headers = array($this->get_columns(), [], []);
    }
    // if ( !is_admin() ) add_filter( 'pre_get_posts', 'prepare_items' );

}

