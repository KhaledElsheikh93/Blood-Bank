

    <div class="form-group">
        <label for="title">Post title</label>
        {!! Form::text('title',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="image">Post image</label>
        {!! Form::file('image',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="content">Post content</label>
        {!! Form::text('content',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="publish_date">Publish date</label>
        {!! Form::date('publish_date',null, ['class' => 'form-control']) !!}
    </div>
    
   
