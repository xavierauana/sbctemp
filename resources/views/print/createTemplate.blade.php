<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Template</title>
</head>
<body>
<div class="container">
    @if($template)
        <form action="/template/update" method="POST">
            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}
            <fieldset>
                <legend>Update Template</legend>
                <textarea name="template" id="template" cols="30" rows="10">{{$template->template}}</textarea>
                <button class="btn btn-default">Update</button>
            </fieldset>
        </form>
    @else
        <form action="/template/create" method="POST">
            {{csrf_field()}}
            <fieldset>
                <legend>Create Template</legend>
                <textarea name="template" id="template" cols="30" rows="10"></textarea>
                <button class="btn btn-default">Create</button>
            </fieldset>
        </form>
    @endif

</div>
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('template');
</script>
</body>
</html>