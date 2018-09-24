<!DOCTYPE html>
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet"
          type="text/css"
          href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet"
          type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <script
            type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script
            type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script
            type="text/javascript"
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>
    <form action="/generator/generate">
       <div class="form-group">
           <div class="col-xs-6">
               <label for="generator-table-name">Table: </label> <br/>
               <input type="text" name="table" class="form-control" id="generator-table-name"> <br/>
           </div>
       </div>

        <div class="form-group">
            <label for="model-name">Model Name: </label> <br/>
            <input type="text" name="model-name" class="form-control" id="model-name"> <br/>
        </div>

        <div class="form-group">
            <label for="namespace">Namespace: </label> <br/>
            <input type="text" name="namespace" class="form-control" id="namespace"> <br/>
        </div>

        <input type="submit" value="Generate">
    </form>

</body>

<script>
    $('#generator-table-name').autocomplete({
        source: '/table/get',
        select: function (event, ui) {
            $('#model-name').val(ui.item.value.charAt(0).toUpperCase() + ui.item.value.slice(1));
            $('#namespace').val('PulpFiction\\model');
        }
    });
</script>