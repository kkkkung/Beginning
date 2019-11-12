<form class="pt-5 pb-3" action="{{ route('statuses.store') }}" method="post">
    <div class="form-group text-left">
        <label for="StatusTextarea"><h2>Input What Are You Thinking</h2></label>
        <textarea class="form-control" name="content" placeholder="Go ahead,Speak your mind boldly. " id="StatusTextarea" rows="1" required></textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <button type="submit" class="btn btn-success btn-lg" >Submit</button>
    </div>
</form>