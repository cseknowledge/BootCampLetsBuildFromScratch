
    <div>Test include</div>

    @if($user == 'arif')
        <h1>Hello, Arif!</h1>
    @elseif($user == 'Jane')
        <h1>Hello, Jane!</h1>
    @else
        <h1>Hello, Stranger!</h1>
    @endif