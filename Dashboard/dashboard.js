$(document).ready(()=>{
    $('#editForm').hide();
    $('.Submitted').hide()
    $('#editButton').click(()=>{
        $('.dashboard-content').hide()
        $('#editForm').show();
    })
    $('#formBack').click((e)=>{
        $('#editForm').hide();
        $('.dashboard-content').show()
    })
    $('#goBack').click(()=>{
        $('#editForm').hide();
        $('.Submitted').hide()
        $('.dashboard-content').show()
    })
})
