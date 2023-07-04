$(document).ready(function(){
    $('#datatable').DataTable();
    $('.dropify').dropify({
        messages: {
            'default': 'Upload',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });
});