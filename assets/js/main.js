// ketika tombol btn menu di klik
const navbarMenu = document.querySelector(".navbar-menu");
// btn menu klik
document.querySelector("#btn-menu").onclick = () => {
  navbarMenu.classList.toggle("active");
};

// menu navbar ketika di klik diluar elemen maka navbar baka nutup
const btnMenu = document.querySelector("#btn-menu");
document.addEventListener("click", function (e) {
  if (!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)) {
    navbarMenu.classList.remove("active");
  }
});

// search form
const searchForm = document.querySelector(".search-form");
const searchBox = document.querySelector("#search-box");
document.querySelector("#btn-search").onclick = (e) => {
  searchForm.classList.toggle("active");
  searchBox.focus();
  e.preventDefault();
};

// raja ongkir
$(document).ready(function () {
  $.ajax({
    url: "data_provinsi.php",
    type: "post",
    success: function (data_provinsi) {
      $("select[name=provinsi]").html(data_provinsi);
    },
  });

  $("select[name=provinsi]").on("change", function () {
    var id_provinsi = $("option:selected", this).attr("id_provinsi");

    $.ajax({
      url: "data_distrik.php",
      type: "post",
      data: "id_provinsi=" + id_provinsi,
      success: function (data_distrik) {
        $("select[name=distrik]").html(data_distrik);
      },
    });
  });

  $.ajax({
    url: "data_paket.php",
    type: "post",
    success: function (data_paket) {
      $("select[name=paket]").html(data_paket);
    },
  });

  $("select[name=distrik]").on("change", function () {
    var prov = $("option:selected", this).attr("nama_provinsi");
    var dist = $("option:selected", this).attr("nama_distrik");
    var type = $("option:selected", this).attr("type_distrik");
    var pos = $("option:selected", this).attr("kode_pos");
    $("input[name=nama_provinsi]").val(prov);
    $("input[name=nama_distrik]").val(dist);
    $("input[name=type_distrik]").val(type);
    $("input[name=kode_pos]").val(pos);
  });

  $("select[name=paket]").on("change", function () {
    var paket = $("option:selected", this).attr("paket");
    var ongkir = $("option:selected", this).attr("ongkir");
    var etd = $("option:selected", this).attr("etd");
    $("input[name=paket]").val(paket);
    $("input[name=ongkir]").val(ongkir);
    $("input[name=estimasi]").val(etd);
  });
});

// pagination
function getPageList(totalPage, page, maxLength) {
  function rage(start, end) {
    return Array.from(Array(end - start + 1), (_, i) => i + start);
  }

  var sideWidth = maxLength < 9 ? 1 : 2;
  var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
  var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

  if (totalPage <= maxLength) {
    return rage(1, totalPage);
  }
  if (page <= maxLength - sideWidth - 1 - rightWidth) {
    return rage(1, maxLength - sideWidth - 1).concat(
      0,
      rage(totalPage - sideWidth + 1, totalPage)
    );
  }

  if (page >= totalPage - sideWidth - 1 - rightWidth) {
    return rage(1, sideWidth).concat(
      0,
      rage(totalPage - sideWidth - 1 - rightWidth - leftWidth, totalPage)
    );
  }

  return rage(1, sideWidth).concat(
    0,
    rage(page - leftWidth, page + rightWidth),
    0,
    rage(totalPage - sideWidth + 1, totalPage)
  );
}

$(function () {
  var numberOfItems = $(".card-produk .card").length;
  var limitPerPage = 6; //jumlah barang didalam halaman barang
  var totalPage = Math.ceil(numberOfItems / limitPerPage);
  var paginationSize = 5; //jumlah angka didalam pagination
  var currentPage;

  function showPage(whichPage) {
    if (whichPage < 1 || whichPage > totalPage) return false;
    currentPage = whichPage;

    $(".card-produk .card")
      .hide()
      .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
      .show();

    $(".pagination li").slice(1, -1).remove();

    getPageList(totalPage, currentPage, paginationSize).forEach((item) => {
      $("<li>")
        .addClass("page-item")
        .addClass(item ? "halaman" : "dots")
        .toggleClass("active", item === currentPage)
        .append(
          $("<a>")
            .addClass("page-link")
            .attr({ href: "javascript:void(0)" })
            .text(item || "...")
        )
        .insertBefore(".next");
    });

    $(".prev").toggleClass("disabled", currentPage === 1);
    $(".next").toggleClass("disabled", currentPage === totalPage);
    return true;
  }

  $(".pagination").append(
    $("<li>")
      .addClass(".page-item")
      .addClass("prev")
      .append(
        $("<a>")
          .addClass("page-link")
          .attr({
            href: "javascript:void(0)",
          })
          .text("prev")
      ),
    $("<li>")
      .addClass(".page-item")
      .addClass("next")
      .append(
        $("<a>")
          .addClass("page-link")
          .attr({
            href: "javascript:void(0)",
          })
          .text("next")
      )
  );

  $(".card-produk").show();
  showPage(1);

  $(document).on("click", "pagination li.halaman:not(.active)", function () {
    return showPage(+$(this).text());
  });

  $(".next").on("click", function () {
    return showPage(currentPage + 1);
  });

  $(".prev").on("click", function () {
    return showPage(currentPage - 1);
  });
});
