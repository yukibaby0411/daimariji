@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <script>
            setTimeout('message_minus()', 1000);
            setTimeout("document.getElementById('message_display').style.display = 'none'", 10000);
            function message_minus() {
                var i = document.getElementById('message_num').firstChild.nodeValue;
                document.getElementById('message_num').innerHTML = parseInt(i)-1;
                setTimeout('message_minus()', 1000);
            }
        </script>
        <div class="flash-message" id="message_display" style="display: block;">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
                <span id="message_num" style="margin-left: 22px;">10</span>s
            </p>
        </div>
    @endif
@endforeach