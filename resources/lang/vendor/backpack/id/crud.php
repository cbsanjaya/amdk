<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => 'Simpan dan Buat Baru',
    'save_action_save_and_edit' => 'Simpan dan Edit',
    'save_action_save_and_back' => 'Simpan dan Kembali',
    'save_action_changed_notification' => 'Perilaku Standar Setelah Penyimpanan Berubah!.',

    // Create form
    'add'                 => 'Tambah',
    'back_to_all'         => 'Kembali ke Semua ',
    'cancel'              => 'Batal',
    'add_a_new'           => 'Tambah Baru ',

    // Edit form
    'edit'                 => 'Ubah',
    'save'                 => 'Simpan',

    // Revisions
    'revisions'            => 'Revisi',
    'no_revisions'         => 'Revisi Tidak ditemukan',
    'created_this'         => 'buat ini',
    'changed_the'          => 'ubah',
    'restore_this_value'   => 'Kembalikan nilai ini',
    'from'                 => 'dari',
    'to'                   => 'ke',
    'undo'                 => 'Undo',
    'revision_restored'    => 'Revisi berhasi dikembalikan',
    'guest_user'           => 'Tamu',

    // Translatable models
    'edit_translations' => 'UBAH TERJEMAHAN',
    'language'          => 'bahasa',

    // CRUD table view
    'all'                       => 'Semua ',
    'in_the_database'           => 'dalam Basis Data',
    'list'                      => 'Daftar',
    'actions'                   => 'Aksi',
    'preview'                   => 'Lihat',
    'delete'                    => 'Hapus',
    'admin'                     => 'Admin',
    'details_row'               => 'Ini adalah detil baris, Ubah Sesuai keinginan Anda.',
    'details_row_loading_error' => 'Ada kesalahan memuat detil. Mohon ulangi!',

        // Confirmation messages and bubbles
        'delete_confirm'                              => 'Anda Yakin akan Menghapus Data ini?',
        'delete_confirmation_title'                   => 'Data Terhapus',
        'delete_confirmation_message'                 => 'Data Berhasil dihapus.',
        'delete_confirmation_not_title'               => 'Tidak Terhapus',
        'delete_confirmation_not_message'             => 'Ada kesalahan. Data Anda mungkin tidak terhapus.',
        'delete_confirmation_not_deleted_title'       => 'Tidak Terhapus',
        'delete_confirmation_not_deleted_message'     => 'Tidak ada yang Berubah. Data anda Aman.',

        // Bulk actions
        'bulk_no_entries_selected_title' => 'Tidak ada data yang dipilih',
        'bulk_no_entries_selected_message' => 'Please select one or more items to perform a bulk action on them.',

        // Bulk confirmation
        'bulk_delete_are_you_sure' => 'Are you sure you want to delete these :number entries?',
        'bulk_delete_sucess_title' => 'Entries deleted',
        'bulk_delete_sucess_message' => ' items have been deleted',
        'bulk_delete_error_title' => 'Delete failed',
        'bulk_delete_error_message' => 'One or more items could not be deleted',

        // Ajax errors
        'ajax_error_title' => 'Error',
        'ajax_error_text'  => 'Error loading page. Please refresh the page.',

        // DataTables translation
        'emptyTable'     => 'No data available in table',
        'info'           => 'Showing _START_ to _END_ of _TOTAL_ entries',
        'infoEmpty'      => 'Showing 0 to 0 of 0 entries',
        'infoFiltered'   => '(filtered from _MAX_ total entries)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ records per page',
        'loadingRecords' => 'Loading...',
        'processing'     => 'Processing...',
        'search'         => 'Search: ',
        'zeroRecords'    => 'No matching records found',
        'paginate'       => [
            'first'    => 'First',
            'last'     => 'Last',
            'next'     => 'Next',
            'previous' => 'Previous',
        ],
        'aria' => [
            'sortAscending'  => ': activate to sort column ascending',
            'sortDescending' => ': activate to sort column descending',
        ],
        'export' => [
            'export'            => 'Export',
            'copy'              => 'Copy',
            'excel'             => 'Excel',
            'csv'               => 'CSV',
            'pdf'               => 'PDF',
            'print'             => 'Print',
            'column_visibility' => 'Column visibility',
        ],

    // global crud - errors
        'unauthorized_access' => 'Unauthorized access - you do not have the necessary permissions to see this page.',
        'please_fix' => 'Please fix the following errors:',

    // global crud - success / error notification bubbles
        'insert_success' => 'The item has been added successfully.',
        'update_success' => 'The item has been modified successfully.',

    // CRUD reorder view
        'reorder'                      => 'Reorder',
        'reorder_text'                 => 'Use drag&drop to reorder.',
        'reorder_success_title'        => 'Done',
        'reorder_success_message'      => 'Your order has been saved.',
        'reorder_error_title'          => 'Error',
        'reorder_error_message'        => 'Your order has not been saved.',

    // CRUD yes/no
        'yes' => 'Yes',
        'no' => 'No',

    // CRUD filters navbar view
        'filters' => 'Filters',
        'toggle_filters' => 'Toggle filters',
        'remove_filters' => 'Remove filters',

    // Fields
        'browse_uploads' => 'Browse uploads',
        'select_all' => 'Select All',
        'select_files' => 'Select files',
        'select_file' => 'Select file',
        'clear' => 'Clear',
        'page_link' => 'Page link',
        'page_link_placeholder' => 'http://example.com/your-desired-page',
        'internal_link' => 'Internal link',
        'internal_link_placeholder' => 'Internal slug. Ex: \'admin/page\' (no quotes) for \':url\'',
        'external_link' => 'External link',
        'choose_file' => 'Choose file',

    //Table field
        'table_cant_add' => 'Cannot add new :entity',
        'table_max_reached' => 'Maximum number of :max reached',

    // File manager
    'file_manager' => 'File Manager',
];
