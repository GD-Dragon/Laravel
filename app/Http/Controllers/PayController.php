<?php
namespace App\Http\Controllers;

use Yansongda\Pay\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PayController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['return','notify']]);
        //构造函数，过滤login
    }
    protected $config = [
        'alipay' => [
            'app_id' => '2016100200643970',
            'notify_url' => 'http://localhost/blog/public/api/auth/notify',
            'return_url' => 'http://localhost/blog/public/api/auth/return',
            'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAj+zDZYa/ZKQpNGc4mWmFpQsrwoxvqVntKH9ZEPdgyyyB3OQs/cIC6GgSk3GC1k1/Ah2JrA1MSdLHF+/TuvAjMI/+GPMA0m5nap/CqYfxc8aCWPdgzoTlV5T9AX7cMi0XpukZm1VEBgPrxfQ1CgGulxxkCDVBu8MHSLumtIfvcCxc1xlDNKwTUDS7mhxIr/4BuyjTDTAD9KpowV+mvM1wAoKglY+0l4Sw97j3lgW1UZcZFEZ3T0kTogtEtpiUaLphjoqY0yjNKPsxfppREWHMCeKfKmV5ijsoszTTKDWPdobAg2mIZDxJm4qCJMq98yejMQ3bjEkL7YjNv/lc/foB+wIDAQAB',
            'private_key' => 'MIIEowIBAAKCAQEA7cA985jZXYdlHgRhlbV75psT4lgfaR9lxhoR5tBuILCjOdCsSFPA63MDf+vXbUD7bOSVEVurEn2M2YbV+laMjIooFQ+uxKBdDvs5Jnc1U482jgPGU5L2FvOXojYhDyyY8Dxz07E7wFSTRdF9UuKi3yQhgktG6romv/yLCKFfVcK9ZaGGduI7fQ0Og7uzTTka1hLDO7Ww1cWb8EWyfvPgfy8ZeY6UGMorJ3ETrkZ0gF1fRATOCJbWbnYRF195vmDGmIuS9wi62lqooSB+BjPlmcdZkTS0yVj6KykBTgMlrNXiN1u9XepBmDdFkiOVg5YK9SPGnZ6vBlJxbbi9oXqIMwIDAQABAoIBADdxVEEhTNc9wrvcQ7F4z/r4AQwQhsqp8r7ex3vu8S+YYYgS/IolVeDSQmerZOJqe/dp2sVgfiVit9zmT7IASuhfM3et35Ck4O6kcTBiLkJdLFiz0qUcqVyy05KVUuJKASRMxKoCM6/nSSzH7JTOmzK0J0hOK6yDWpP83aNWlnfV7eEQqFlNI8/03tTahnDFVvN/UY5d/bVXpf6jzEpLDeZL0LvQBqFsbs0Dd1Vpe/mk+Mkdy1uuT6CRMX7SVFpAh379kCP3uscqJWkLykacpD9yvYt93qLJ0iF4izWhPMXSovtudRnx3n2xaeJjRJmkU3RhD3VDlCPirM5F2Fl0+ykCgYEA/QlaXFOdJQNezzjtJbkdELjGBq3q87ySeXbXKlWXhlgAU/FGJNcczxkCPxE1aDF3PltXfgFeqTeg2D17vhT8nCXgyNzOHsNfJJltNNLfwlSU5vWY8CkaZjwSVAsrCJmKp3mO1PREbX1f+4918/3EkigGE4LOG3flmsomvEhckDUCgYEA8IkPaVr5bFquN6AC6R2nF1ml1RC49wiG4dh2K90wmKTROAMvuFC328XDohh9BCYC8v5xcBkDn+yylKk/qFru6mKAdVoigoNpH04mcPFqkbj1/qfyXeId9zoR5DeQQ2qkPuCvRF3wh3HLjdID3QoMjL1LdxClgPSS2c5BvhbYk8cCgYAd2GaSEUKtxPH/2yUNmAH3oPOqggT+brWQIhZK5gGTVPnk7MZrPfwl6Ts8mRkFiyAXeMqfECZMK0WLe+UGjI8nE8ipqHGfa0fjlz0sR9sgnr1ZaIp7eT2l5Vv8Eb0nrISQMGRKde1ERM93anptJvdyjcn5ryoET2YDlehvuNFCKQKBgHHZrf3EHcL3uPaDOl10t54JxMBwxdvHoXBMsMJaU6IsgQruFyw6qIvRs6OJy8Km60ZwwOi6LkkIFA7hfUwGnoc6UGs7WpJD+QHkT7Wtzy9iSK1ceQ+O83gNeGJ5GkOOumc4mjzV6f9yEVLzUPjSxNXo00tsCapcGRYW1m9PCPwJAoGBAM6i1am03HYiiuiFsEwRNFoFtubdkNsUU/KQ641TWHFs0YGRjRuxrfuKlGEn0xPkLovAtawdqm2wPsB0eBSgPg57q1Z/ovRKJe9aTg03vVWnZkJWR0L4f4+rHjFlkutaKKp1mE8PMKxZfZkbdWUc1E1SK+Hs4QKNLGPCP4NY9niT',
        ],
    ];

    public function index(Request $request)
    {
        $arr=$request->input();
        $config_biz = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject'      => 'test subject',
        ];

        $pay = new Pay($this->config);

        return $pay->driver('alipay')->gateway()->pay($config_biz);
    }

    public function return(Request $request)
    {
        $pay = new Pay($this->config);

        // return $pay->driver('alipay')->gateway()->verify($request->all());
        header("location:http://localhost:8080/#/Index");
    }

    public function notify(Request $request)
    {
        $pay = new Pay($this->config);

        if ($pay->driver('alipay')->gateway()->verify($request->all())) {
            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。 
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号； 
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）； 
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）； 
            // 4、验证app_id是否为该商户本身。 
            // 5、其它业务逻辑情况
            file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单号：' . $request->out_trade_no . "\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单金额：' . $request->total_amount . "\r\n\r\n", FILE_APPEND);
        } else {
            file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
        }

        echo "success";
    }
}