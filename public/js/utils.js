function updateAvatarPreview(input, imageHolder)
{
    imageHolder.src = URL.createObjectURL(input.files[0]);
}

// function showModalComment(post)
// {
//     // alert(123);
//
//     // $.get("/create_comment", ()=>{alert(111);});
//
//     $.ajax({
//         type: 'GET',
//         url : "/create_comment",
//     });
//
//     // $(document).ready(function(){
//     //     $("#myBtn").click(function(){
//     //         $("#myModal").modal();
//     //     });
//     // });
//     //
//     // $(document).ready(function(){
//     //     $("#myBtn").click(function(){
//     //         $("#myModal").modal();
//     //     });
//     // });
// }
