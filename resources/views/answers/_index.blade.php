<div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                
                @include('layouts._messages')
                
                @foreach ($answers as $answer)
                <div class="media">
                    @include('shared._vote', [
                            'model' => $answer
                        ])
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can ('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$answer->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                    @endcan
                                    
                                    @can ('delete', $answer)
                                    <form class="form-delete" action="{{ route('questions.answers.destroy', [$answer->id, $answer->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Are You Sure?')">{{ __('Del') }}</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                @include('shared._author', [
                                'model' => $answer,
                                'lable' => 'answered'
                                ])
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>