<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>BooksMoscow DropCart Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="background-color: #f2f4f7; ">

<table align="center"  cellpadding="0" cellspacing="0" width="600" style="border: 1px solid grey;">
    <table width="100%;">
        <tr align="center" bgcolor="f2f4f7"; style="padding: 40px 0 30px 0;  margin: 5px 5px 5px 5px;">
            <img src="https://i.ibb.co/FJmbZMt/Book-Moscow.png" alt="Books Moscow"  style="display: block;" />
        </tr>
    </table>
    <tr style="background-color: #dfe4eb;">
        <td style="font-size: 14px;padding: 10px;">
            {{--            <p><b>Привет, {{ $newSendArr[0] -> sendArr[0] -> user_name }} </b></p>--}}
            <p><b>Привет,</b></p>
            <p>3 дня назад вы оставили товары в корзине и срок резерва на них уже заканчивается,
                но у меня появилась хорошая идея: давайте я сделаю вам приятный сюрприз :) Если
                вы оформите заказ <b> сегодня до 23.00, то сможете купить со скидкой 8%.</b> Просто укажите
                <b> промокод CODE872 </b> при оформлении заказа. </p>
            <p>По-моему, это отличный повод чуть-чуть поторопиться :)</p>
        </td>
    </tr>
    <tr style="background-color: #f2f4f7;padding: 10px;">
        <p style="font-size: 16px; padding: 10px; width: 100%;">Ваша корзина:</p>
    </tr>
    <tr>
        <table style="background-color: white;padding: 10px;border: 1px dot-dot-dash grey;">
            @foreach ($newSendArr[0] -> sendArr as $good)
                <tr>
                    <td width="20%"  style="padding: 10px 10px 10px 5px;">
                        <a href="https://booksmoscow.ru/cart"><img src="{{ $good->good_image }}" width="100%" alt=""/></a>
                    </td>
                    <td style="font-size: 20px;text-align: center;">
                        <a href="https://booksmoscow.ru/cart" style="text-decoration: none;"> {{ $good -> good_name }} </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </tr>
    <tr style="border: 10px dot-dot-dash grey;">
        <a href="https://booksmoscow.ru/cart?utm_source=email&utm_medium=bk&utm_campaign=bk_3d">
            <button  type="button" style="background-color: #70bbd9; border:none; color: white;text-align: center;font-size: large; display: inline-block; width: 100%; height: 70px; ">
                Вернуться к покупкам
            </button>
        </a>
    </tr>
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