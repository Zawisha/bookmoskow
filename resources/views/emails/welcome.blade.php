
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>BooksMoscow DropCart Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
{{--    <style type="text/css">--}}
{{--        @media only screen and (max-device-width: 480px) {--}}
{{--            /* сюда пишутся мобильные CSS-стили */--}}
{{--            .column{--}}
{{--                width: 200px;--}}
{{--            }--}}
{{--        }--}}

{{--    </style>--}}
</head>
<body style="background-color: #f2f4f7;padding: 0;min-width: 100%;">

<table align="center"  cellpadding="0" cellspacing="0" style="border: 1px solid grey;width: 100%;max-width: 600px">
    <table width="100%;">
            <tr align="center" bgcolor="f2f4f7"; style="padding: 40px 0 30px 0;  margin: 5px 5px 5px 5px;">
                <img src="https://i.ibb.co/FJmbZMt/Book-Moscow.png" alt="Books Moscow"  style="display: block;" />
            </tr>
    </table>
    <tr style="background-color: #dfe4eb;">
        <td style="font-size: 14px;padding: 10px;">
            <br>
           <b> <p style="font-size: 18px; padding: 10px; width: 100%;">Вам скидка 100 руб и больше не забывайте))</p> </b>
            <br>


            <p><b>Привет !</b></p>
            <p>Сегодня вы добавили в корзину товары и не завершили заказ.
                Если они вам еще нужны, то я просто напомню, что мы зарезервировали их специально для вас,
                но резерв истечет уже через 2 дня.</p>
            <p>Чтобы Вам было приятно мы добавили Вам скидку 100 руб введите sk100 в специальном поле при оформлении заказа
                и если Ваш заказ будет на 1500 и более получите скидку 100 руб</p>
        </td>
    </tr>

    <tr style="background-color: #f2f4f7;padding: 10px;">
        <p style="font-size: 16px; padding: 10px; width: 100%;">Ваша корзина:</p>
    </tr>


    @foreach ($newSendArr[0] -> sendArr as $good)

{{--        <tr>--}}
{{--            <td class="two-column" style="text-align: center;font-size: 0;">--}}


{{--                <table width="100%">--}}
{{--                     <tr>--}}
{{--                         <td style="width: 250px;">--}}


                             <div class="column" style="width: 50%;max-width: 297px;display: inline-block;text-align: center;vertical-align: middle;">
                                 <table width="100%">
                                     <tr style="padding: 20px">
                                         <td class="inner" style="padding: 3px;">
                                             <table class="contents" style="width: 100%;font-size: 14px;text-align: center;background-color: white; border: 1px solid lightgrey;">
                                                 <tr>
                                                     <td style="padding: 4px">
                                                         <a href="https://booksmoscow.ru/cart"><img src="{{ $good->good_image }}" style="width: 100%;height: auto;" alt=""/></a>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td class="text1" style="padding-top: 1px;">
                                                        <p style="color: red;">CКИДКА до 80%</p>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td class="text2">
                                                         <a href="https://booksmoscow.ru/cart" style="text-decoration: none;padding-top: 10px;">
                                                             <p style="width: 250px;height: 40px; overflow: hidden;padding: 5px; color: black;"> {{ $good -> good_name }}</p>
                                                         </a>
                                                     </td>
                                                 </tr>
                                             </table>
                                         </td>
                                     </tr>
                                 </table>
                             </div>
{{--                        </td>--}}
{{--                     </tr>--}}
{{--                </table>--}}


{{--            </td>--}}
{{--        </tr>--}}




{{--        <tr>--}}
{{--            <td style="display: inline-block;text-align: center;font-size: 0;">--}}

{{--                <div style="width: 100%;max-width: 300px;display: inline-block;">--}}

{{--                    <table style="background-color: dodgerblue;width: 100%;font-size: 14px; text-align: center">--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <a href="https://booksmoscow.ru/cart"><img src="{{ $good->good_image }}" style="width: 100%;height: auto;" alt=""/></a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <p style="color: red;padding-top: 10px;">СКИДКА до 80% </p>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td style="white-space: nowrap;width: 280px;height: 40px;">--}}
{{--                                <a href="https://booksmoscow.ru/cart" style="text-decoration: none;padding-top: 10px;"> {{ $good -> good_name }} </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}

{{--                </div>--}}

{{--            </td>--}}
{{--        </tr>--}}



    @endforeach
{{--    <tr style="border-collapse:collapse">--}}
{{--    <table style="background-color: white;padding: 10px;border: 1px dot-dot-dash grey;">--}}
{{--            @foreach ($newSendArr[0] -> sendArr as $good)--}}
{{--            <td  style="display: inline-block;width:300px;">--}}
{{--                    <tr width="20%"  style="padding: 10px 10px 10px 5px;">--}}
{{--                        <a href="https://booksmoscow.ru/cart"><img src="{{ $good->good_image }}" width="30%" alt=""/></a>--}}
{{--                     </tr>--}}
{{--                    <tr style="font-size: 20px;text-align: center;float:inherit;">--}}
{{--                        <a href="https://booksmoscow.ru/cart" style="text-decoration: none;"> {{ $good -> good_name }} </a>--}}
{{--                    </tr>--}}
{{--            </td>--}}
{{--            @endforeach--}}


    <table style="width: 100%;">
        <tr style="border: 10px dot-dot-dash grey;">
            <a href="https://booksmoscow.ru/cart?utm_source=email&utm_medium=bk&utm_campaign=bk_30min">
                <button  type="button" style="background-color: #70bbd9; border:none; color: white;text-align: center;font-size: large; display: inline-block; width: 100%; height: 70px; ">
                    Вернуться к покупкам
                </button>
            </a>
        </tr>
    </table>
    <table style="background-color: #dfe4eb;">
        <tr>
            <p style="font-size: 14px;padding-left: 10px">
                <br>
                <br>
                <br>
               <i>
                   Обратите внимание: спрос на популярные товары очень высокий,
                   так что я не могу обещать, что они постоянно будут в наличии.
                   Поэтому советую поспешить, пока не истёк срок вашего резерва.
               </i>
                <br>
                <br>
                <br>
            </p>
        </tr>
    </table>
    <table style="padding-top: 50px; padding-bottom: 50px;padding-left: 50px;">
        <tr>
        <td align="center" width="170px" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; border-radius: 80%">
            <img src="https://cdn.iconscout.com/icon/free/png-256/man-support-2122174-1786505.png" alt="Support" width="60%" height="40%" style="display: block; align-content: center;" />
        </td>
        <td  style="align-content: left; padding-left: 50px;">
            <b><p>Сергей Загородный</p>
            <p style="font-size: 12px;">Служба заботы о покупателях</p>
            <p>admin@booksmoscow.ru</p>
            <p>+7 (495) 241-00-56</p></b>
        </td>
     </tr>
    </table>
    <tr style="background-color: #dfe4eb;">
        <td style="font-size: 10px;padding: 1px;">
            <p>Если вы не желаете быть в курсе последних акций,
                получать новые бонусы и промокоды - вы можете отписаться от нашей рассылке нажав на кнопку ниже.</p>
        </td>
    </tr>

    <tr style="border: 10px dot-dot-dash grey;">
        <a href="http://okmos.ru/unsub_email/{{ $newSendArr[0] -> sendArr[0] -> user_email }}&{{ $email_token }}">
            <button  type="button" style="background-color: #C0C0C0; border:none; color: white;text-align: center;font-size: small; display: inline-block; width: 100%; height: 18px;">
                Отписаться
            </button>
        </a>
    </tr>
</table>
</body>
</html>