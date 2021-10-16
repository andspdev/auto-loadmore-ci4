<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Coba Auto Load More ketika Scroll</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                background: #f9f9f9;
                padding: 10px;
                margin: 10px;
            }

            .box-center {
                margin: 3em auto;
                background: #fff;
                max-width: 500px;
                padding: 20px;
                border: 1px solid #ddd;
                box-shadow: 0 0 10px #ddd;
            }
            .box-center .title {
                margin-bottom: 20px;
                border-bottom: 1px dashed #ccc;
                padding: 20px;
                text-align: center
            }
            .box-center .title h1 {
                margin: 0;
                padding: 0;
                font-size: 25px
            }
            .box-center .hasilPesan, .box-center .loader {
                text-align: center;
            }
            .box-center .loader.bottom {
                border-top: 1px dashed #ddd;
                margin-top: 20px;
                padding-top: 20px;
            }
        </style>
    </head>
    <body>

        <div class="box-center">
            <div class="title"><h1>Nama negara dan kodenya</h1></div>

            <div class="hasil_load"></div>
            <div class="hasilPesan"></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() 
            {
                let startData     = <?=$startData?>;
                let loadMore      = true;
                const hasilLoad   = $('.hasil_load');
                const hasilPesan  = $('.hasilPesan');
                const limitData   = <?=$limitData?>;
                const imgLoader   = '<img src="<?=base_url('loader.svg')?>" alt="Loader" width="40" height="40" />';

                hasilPesan.html(`
                    <div class="loader">
                        ${imgLoader}
                    </div>
                `);

                const LoadMore    = (limit, start) =>
                {
                    $.ajax({
                        url: '<?=base_url('/loadmore/data')?>',
                        method: 'POST',
                        data: {startData: start, limitData: limit},
                        success: (data) =>
                        {
                            const err       = data.err;
                            const countries = data.countries;

                            if (err !== null)
                            {
                                hasilPesan.html(`<br/>${err}`);

                                if (Array.isArray(countries) && countries.length == 0)
                                    setTimeout(() => {
                                        hasilPesan.html(null);
                                    }, 4000);

                                loadMore = false;
                            }
                            else
                            {
                                $.each(countries, (key, val) => 
                                {
                                    hasilLoad.append(`
                                        <b>Negara</b>: ${val.name}<br/>
                                        <b>Kode</b>: ${val.code}<br/><br/>
                                    `); 
                                });

                                loadMore = true;
                                hasilPesan.html(null);
                            }
                        }
                    });
                }

                if (loadMore)
                {
                    loadMore = false;

                    setTimeout(() =>
                    {
                        LoadMore(limitData, startData);
                    }, 800);
                }

                $(window).scroll(function()
                {
                    if ($(window).scrollTop() + $(window).height() > $(".hasil_load").height() && loadMore)
                    {
                        loadMore = false;
                        startData = startData + limitData;
                        
                        setTimeout(() =>
                        {
                            LoadMore(limitData, startData);
                        }, 800);

                        
                        hasilPesan.html(`
                            <div class="loader bottom">
                                ${imgLoader}
                            </div>
                        `);
                    }
                });
            });
        </script>
    </body>
</html>
