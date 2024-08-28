<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- boótrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    {{-- css --}}

</head>
<body>
    <style>
        .abs,
h2:after,
.cards .card figcaption,
.cards .card:after,
.news .card figcaption,
.news .card:after,
.news .article figcaption {
  position: absolute;
}
.rel,
h2,
h2 strong,
.cards .card,
.news .card,
.news .article {
  position: relative;
}
.fix {
  position: fixed;
}
.dfix {
  display: inline;
}
.dib {
  display: inline-block;
}
.db {
  display: block;
}
.dn {
  display: none;
}
.df,
.cards,
.news {
  display: flex;
}
.dif {
  display: inline-flex;
}
.dg {
  display: grid;
}
.dig {
  display: inline-grid;
}
.vm,
h2,
h2 strong,
h2 span {
  vertical-align: middle;
}
body {
    background: rgb(138,34,195);
    background: linear-gradient(0deg, rgba(138,34,195,0.6853335084033614) 0%, rgba(45,142,253,0.7105435924369747) 100%);
    background-repeat: no-repeat;
    background-size: cover; /* Ensures the background covers the entire screen */
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
    margin: 0; /* Removes default margin */
    height: 100vh; /* Ensures body height is 100% of viewport height */
    font-family: 'Alegreya Sans', sans-serif; /* Font family with fallback */
}

.wrapper {
  padding: 15px;
}
h2 {
  padding: 10px;
  padding-left: 25px;
  color: #ffffff;
  margin: 0;
}
h2 strong {
  z-index: 2;
  /* background: #24282f; */
  padding: 4px 8px;
}
h2 span {
  font-size: 0.7em;
  color: #aaa;
  margin-left: 10px;
}

.cards,
.news {
  flex-flow: row wrap;
}
.cards .card,
.news .card {
  margin: 20px;
  width: 180px;
  height: 270px;
  overflow: hidden;
  box-shadow: 0 5px 10px rgba(0,0,0,0.8);
  transform-origin: center top;
  transform-style: preserve-3d;
  transform: translateZ(0);
  transition: 0.3s;
}
.cards .card img,
.news .card img {
  width: 100%;
  min-height: 100%;
}
.cards .card figcaption,
.news .card figcaption {
  bottom: 0;
  left: 0;
  right: 0;
  padding: 20px;
  padding-bottom: 10px;
  font-size: 20px;
  background: none;
  color: #fff;
  transform: translateY(100%);
  transition: 0.3s;
}
.cards .card:after,
.news .card:after {
  content: '';
  z-index: 10;
  width: 200%;
  height: 100%;
  top: -90%;
  left: -20px;
  opacity: 0.1;
  transform: rotate(45deg);
  background: linear-gradient(to top, transparent, #fff 15%, rgba(255,255,255,0.5));
  transition: 0.3s;
}
.cards .card:hover,
.news .card:hover,
.cards .card:focus,
.news .card:focus,
.cards .card:active,
.news .card:active {
  box-shadow: 0 8px 16px 3px rgba(0,0,0,0.6);
  transform: translateY(-3px) scale(1.05) rotateX(15deg);
}
.cards .card:hover figcaption,
.news .card:hover figcaption,
.cards .card:focus figcaption,
.news .card:focus figcaption,
.cards .card:active figcaption,
.news .card:active figcaption {
  transform: none;
}
.cards .card:hover:after,
.news .card:hover:after,
.cards .card:focus:after,
.news .card:focus:after,
.cards .card:active:after,
.news .card:active:after {
  transform: rotate(25deg);
  top: -40%;
  opacity: 0.15;
}
.news .article {
  overflow: hidden;
  width: 350px;
  height: 235px;
  /* margin: 20px; */
}
.news .article img {
  width: 100%;
  height: 100%;
  transition: 0.2s;
  object-fit: cover;
  border-radius: 16px;
}
.news .article figcaption {
  font-size: 14px;
  text-shadow: 0 1px 0 rgba(51,51,51,0.3);
  color: #fff;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  padding: 40px;
  box-shadow: 0 0 2px rgba(0,0,0,0.2);
  /* background: rgba(6,18,53,0.6); */
  opacity: 0;
  transform: scale(1.15);
  transition: 0.2s;
}
.news .article figcaption h3 {
  color: #ffffff;
  font-size: 26px;
  margin-bottom: 0;
  font-weight: bold;
}
.news .article:hover img,
.news .article:focus img,
.news .article:active img {
  filter: blur(2px) brightness(0.5);
  transform: scale(0.97);
}
.news .article:hover figcaption,
.news .article:focus figcaption,
.news .article:active figcaption {
  opacity: 1;
  transform: none;
}
a {
  color: #ffffff;
  text-decoration: none;
}
a:hover {
    color: #4da9ff !important;
    text-decoration: none !important;
}
    </style>
    <div class="wrapper">

        {{-- <h2><strong>All Games<span>( 4 )</span></strong></h2>
    
        <div class="cards">
    
            <figure class="card">
    
                <img src="https://i.ibb.co/dpDJZ2b/1.jpg" />
    
                <figcaption>Dota 2</figcaption>
    
            </figure>
    
            <figure class="card">
    
                <img src="https://i.ibb.co/X7nQxgj/2.jpg" />
    
                <figcaption>Stick Fight</figcaption>
    
            </figure>
    
            <figure class="card">
    
                <img src="https://i.ibb.co/FqTvB96/3.jpg" />
    
                <figcaption>Minion Masters</figcaption>
    
            </figure>
    
            <figure class="card">
    
                <img src="https://i.ibb.co/4P0CDKX/4.jpg" />
    
                <figcaption>KoseBoz!</figcaption>
    
            </figure>
    
        </div> --}}
    
        {{-- <h2><strong>TỔ ĐIỆN TOÁN</strong></h2> --}}
        <div><img style="width: 200px;" src="https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-VietinBank-CTG-Te.png" alt=""></div>
    
        <div class="news row mt-5">
    
            <figure class="article col-md-3 col-lg-3 col-12">
    
                <img src="https://img.freepik.com/free-vector/qr-code-scanning-concept-with-characters_23-2148616315.jpg" />
    
                <figcaption>
    
                   <h3> <a href="/qr-code">Tạo mã QR code</a></h3>
    
                    <p>
    
                        Tạo mã QR code cho khách hàng dễ dàng quét để xem thông tin chuyển khoản, một cách nhanh chóng và tiện lợi.
    
                    </p>
    
                </figcaption>
    
            </figure>
    
            <figure class="article col-md-3 col-lg-3 col-12">
                <img src="https://img.myloview.com/stickers/illustration-of-operating-a-smartphone-making-an-electronic-payment-700-252410846.jpg" />
                <figcaption>
                  <h3> <a href="/staff-qr-code">QR code cán bộ</a></h3>
                    <p>
                        Qr code dành cho cán bộ Vietinbank, dùng để điểm danh hoặc tham gia trong các hoạt động của chi nhánh.
                    </p>
                </figcaption>
            </figure>

            <figure class="article col-md-3 col-lg-3 col-12">
    
                <img src="https://img.graphicsurf.com/2019/12/data-analysis-vector-free-illustration1.jpg" />
    
                <figcaption>
    
                    <h3><a href="">Phân tích dữ liệu</a></h3>
    
                    <p>
    
                        Tính năng đang trong quá trình phát triển, vui lòng truy cập sau.
    
                    </p>
    
                </figcaption>
    
            </figure>
    
            
        </div>
    
    </div>
</body>
</html>
{{-- boostrap script import --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- font awesome script import --}}
