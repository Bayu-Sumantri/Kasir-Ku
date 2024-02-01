
<script>
    // data target start
    document.getElementById('data-target').addEventListener('click', function() {
        // Get the target URL from the data-target attribute
        var targetUrl = this.getAttribute('data-target');

        // Redirect to the target URL
        window.location.href = targetUrl;
    });
    // data target end
</script>



<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>
