<!DOCTYPE html>
<head>
    <script src="{{ $token_script_url ?? config('laravel-softbank.token_endpoint') }}"></script>
</head>

<body>
    <div id="result"></div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            com_sbps_system.generateToken({
                merchantId: "{{ $merchant_id }}",
                serviceId: "{{ $service_id }}",
                ccNumber: "{{ $cc_num }}",
                ccExpiration: "{{ $cc_exp }}",
                securityCode: "{{ $cc_seq }}"
            }, (res) => {
                const result = document.getElementById('result')
                result.append(JSON.stringify(res))
            });
        })
    </script>

</body>
</html>
