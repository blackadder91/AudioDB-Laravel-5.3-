            <footer id="page-footer">
                <p>© 2016-2017</p>
            </footer>
        </div>
        <meta name="_token" content="{!! csrf_token() !!}" />
        {{-- Scripts --}}
        <script src="/js/select2.min.js"></script>
        <script src="/js/jQuery.matchHeight.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/framework/general.js"></script>
        <script src="/framework/entity.js"></script>
        @stack('scripts')
    </body>
</html>
