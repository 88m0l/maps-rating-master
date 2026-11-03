<div
    style="background-color: {{ $color == 'blue' ? '#d1e7ff' : ($color == 'red' ? '#f8d7da' : '') }}; color: {{ $color == 'blue' ? '#004085' : ($color == 'red' ? '#721c24' : '') }};"
    class="relative py-3 px-3 rounded-lg">
    {{ $message }}
</div>
