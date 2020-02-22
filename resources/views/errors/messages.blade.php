@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="row alert alert-danger" style="min-height: 0px;">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $key=>$error)
                <div class="col-md-4">

                    <ol><i style="color:black;">{{$key + 1 }}.</i>{{ $error }}</ol>
                </div>
            @endforeach
        </ul>
    </div>
@endif
