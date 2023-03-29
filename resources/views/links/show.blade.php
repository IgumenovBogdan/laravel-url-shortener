<x-layout>
    <div class="decor">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
        <div class="form-inner">
            <div class="message">
                <p>Copied</p>
            </div>
            <h3>{{ $link  }}</h3>
            @csrf
            <input id="copy-button" onclick="copyToClipboard('{{$link}}')" type="submit" value="Copy">
        </div>
    </div>
</x-layout>

<script>
    function copyToClipboard(text) {

        const btn = document.getElementById('copy-button');

        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(text)
                .then(() => {
                    console.log('here')
                    const message = document.querySelector('.message');
                    message.style.display = 'block';
                })
                .catch(err => {
                    console.error('Failed to copy text');
                });
        });
    }
</script>

</body>
</html>
