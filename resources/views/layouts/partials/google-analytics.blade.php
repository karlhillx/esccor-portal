<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '{{ config('gamp.tracking_id') }}']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' === document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<script language="javascript" id="_fed_an_ua_tag"
        src="https://dap.digitalgov.gov/Universal-Federated-Analytics-Min.js?agency=NASA&subagency=GSFC&dclink=true"></script>
