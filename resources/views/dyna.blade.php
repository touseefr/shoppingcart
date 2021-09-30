<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <form action="/dyna" method="post">
    @csrf
    <div class="input_fields_wrap">
        <input type="text" name="name[]" placeholder="enter name">
        <button class="add_field_button">Add More Fields</button>
    </div>
    <input type="submit" value="submit">
    </form>
</body>

</html>

<script>
    $(document).ready(function(){
        var max_fields=4;   //maximum fields
        //var wrapper=$('.input_fields_wrap')  //whole div in one unit wrap
        //var add_button=$('.add_field_button')  //get add button id to process on click

        var x = 1; //initlal text box count
        //console.log(add_button);

        $('.add_field_button').click(function(e){
            e.preventDefault()
            if(x<max_fields) //max input fields
            {
                $('.input_fields_wrap').append('<div><input type="text" name="name[]"/><a href="#" class="remove_field">Remove</a></div>')
                x++;
            }
        })
 
        $('.input_fields_wrap').on("click",".remove_field", function(e){ //user click on remove text
       
       e.preventDefault(); 
       $(this).parent('div').remove(); 
       x--;
   })



    })
</script>