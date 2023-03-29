<x-layout>
    <form class="decor" method="POST" action="{{route('links.create')}}">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <h3>Shorten link</h3>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
            @endif
            @if ($message = Session::get('error'))
                <div class="error">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @csrf
            <textarea class="url-input" placeholder="Enter link to shorten" name="url" rows="2"></textarea>
            <input type="hidden" name="session_id" id="session_id_input" value="">
            <input type="submit" value="Shorten">
        </div>
    </form>
</x-layout>
