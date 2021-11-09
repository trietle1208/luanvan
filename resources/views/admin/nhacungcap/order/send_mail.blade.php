<html>
    <head>
        <title>Mail đến khách hàng</title>
    </head>
    <body>
    <h3>Chào, {{ $customer->kh_hovaten }}</h3>
    <p>Đơn hàng {{ $order->dh_madonhang }} đã được giao thành công!</p>
    <p>Cảm ơn bạn đã ghé thăm cửa hàng và mua hàng lần đầu tiên tại cửa
        hàng của chúng tôi! Chúng tôi rất vui vì bạn đã tìm thấy những
        gì bạn đang tìm kiếm.
    </p>
    <p>
        Mục tiêu của chúng tôi đó là bạn luôn hài lòng với những gì bạn đã mua từ , vì vậy, hãy cho chúng tôi biết nếu bạn không thực sự hài lòng với trải nghiệm tại đây. Đóng góp của bạn là động lực
        để chúng tôi có thể hoàn thiện và mang đến dịch vụ tốt nhất.
    </p>
    <p>
        Bạn vui lòng kiểm tra lại các sản phẩm và vào đường link bên dưới để xác nhận nhận hàng dùm bên mình nhé!
        Chúng tôi mong sẽ được phục vụ bạn nhiều lần nữa. Chúc bạn có một ngày tuyệt vời!
    </p>
    <a href="{{ route('trangchu') }}" target="_blank">Xác nhận nhận hàng</a>
    <p>
        Trân trọng,
    </p>
    </body>
</html>


