<?php

defined( 'ABSPATH' ) or exit;
$datetime_format = sprintf('%s %s', get_option( 'date_format' ), get_option( 'time_format' ) );
?>

</form><?php // close main form. This means this always has to be the last tab or it will break stuff. ?>

<h2><?php _e( 'Form Submissions', 'html-forms' ); ?></h2>

<form method="post">
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e( 'Select bulk action' ); ?></label>
            <select name="_hf_admin_action" id="bulk-action-selector-top">
                <option value=""><?php _e( 'Bulk Actions' ); ?></option>
                <option value="bulk_delete_submissions"><?php _e( 'Move to Trash' ); ?></option>
            </select>
            <input type="submit" class="button action" value="<?php _e( 'Apply' ); ?>">
        </div>

        <div class="tablenav-pages one-page">
            <span class="displaying-num"><?php echo sprintf( __( '%d items' ), count( $submissions ) ); ?></span>
        </div>

        <br class="clear">
    </div>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column"><input type="checkbox" /></td>
                <th scope="col" class="manage-column">Timestamp</th>
                <?php foreach( $columns as $column ) {
                    echo sprintf( '<th scope="col" class="manage-column">%s</th>', esc_html( ucfirst( strtolower( $column ) ) ) );
                } ?>
            </tr>
        </thead>
        <tbody>

        <?php foreach( $submissions as $s ) { ?>
           <tr>
               <th scope="row" class="check-column">
                   <input type="checkbox" name="id[]" value="<?php echo esc_attr( $s->id ); ?>"/>
               </th>
               <td>
                   <abbr title="<?php echo date( $datetime_format, strtotime( $s->submitted_at ) ); ?>"><?php echo esc_html( $s->submitted_at ); ?></abbr>
               </td>
               <?php foreach( $columns as $column ) {
                   $value = isset( $s->data[ $column ] ) ? $s->data[ $column ] : '';
                   if( is_array( $value ) ) {
                       $value = join( ', ', $value );
                   }
                   $value = esc_html( $value );

                   echo sprintf( '<td>%s%s</td>', substr( $value, 0, 100 ), strlen( $value ) > 100 ? '...' : '' );
               } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</form>


<form><?php // open new main form. This means this always has to be the last tab or it will break stuff. ?>
