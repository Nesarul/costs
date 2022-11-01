
showForeign = () =>{
    $.ajax({
        type:'POST',
        url:'../../admin/api_anagrams.php',
        data: $('#searchForm').serialize(),
        //dataType:'JSON',
        success:function(data){
            //$('#resDivs').empty();
            $('#resDivs').append(data);
        },
        error:function(data){
            alert("Failed");
        },
    });
}