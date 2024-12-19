// phần 1 thông tin sản phẩm
// var splide = new Splide(".splide", {
//   type: "loop",
//   perPage: 5,
//   focus: "center",
// });

// splide.mount();
// phần các sản phẩm khác của shop
// var splide = new Splide(".splide", {
//   type: "loop",
//   drag: "free",
//   perPage: 5,
// });

// splide.mount();
document.addEventListener("DOMContentLoaded", function () {
  new Splide("#product-information", {
    perPage: 5,
    perMove: 1,
    gap: "30px",
    pagination: false,
  }).mount();
});

document.addEventListener("DOMContentLoaded", function () {
  new Splide("#other-products", {
    perPage: 6,
    perMove: 1,
    gap: "30px",
    pagination: false,
  }).mount();
});
