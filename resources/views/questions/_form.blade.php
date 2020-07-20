@csrf
<div class="form-group">
    <label for="question-title">{{ __('Question Title') }}</label>
    <input type="text" name="title" id="question-title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $question->title) }}">
    @error('title')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="question-body">{{ __('Explain Your Question') }}</label>
    <textarea name="body" id="question-body" rows="10" class="form-control @error('body') is-invalid @enderror">{{ old('body', $question->body) }}</textarea>
    @error('body')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ __($buttonText) }}</button>
</div>