// Side Navbar
const menuBar = document.querySelector('.bi-list');
const menu_bar = document.querySelector('.menu-bar');
const sideNav = document.querySelector('.sideNav');
const navExpand = document.querySelector('.sideNavExpand');

menuBar.addEventListener('mouseover', function() {
  menu_bar.classList.add('border-info');
  menu_bar.classList.add('border-3');
  menu_bar.classList.add('btn');
});
menuBar.addEventListener('mouseleave', function() {
  menu_bar.classList.remove('border-info');
  menu_bar.classList.remove('border-3');
});
menuBar.addEventListener('click', function(){
  navExpand.classList.remove('d-none')
  navExpand.classList.add('d-block')
  sideNav.classList.add('d-none');
});

const dashboardBtn = document.querySelector('.bi-house-door');
const dashboard_btn = document.querySelector('.dashboard-btn');

dashboardBtn.addEventListener('mouseover', function() {
  dashboard_btn.classList.add('border-info');
  dashboard_btn.classList.add('border-3');
  dashboard_btn.classList.add('btn');
  edit_btn.classList.remove('border-info');
  edit_btn.classList.remove('border-3');
  edit_btn.classList.remove('btn');
})
dashboardBtn.addEventListener('mouseleave', function() {
  dashboard_btn.classList.remove('border-info');
  dashboard_btn.classList.remove('border-3');
  dashboard_btn.classList.remove('btn');
  edit_btn.classList.add('border-info');
  edit_btn.classList.add('border-3');
  edit_btn.classList.add('btn');
})

const hitungBtn = document.querySelector('.bi-calculator');
const hitung_btn = document.querySelector('.hitung-btn');

hitungBtn.addEventListener('mouseover', function() {
  hitung_btn.classList.add('border-info');
  hitung_btn.classList.add('border-3');
  hitung_btn.classList.add('btn');
  edit_btn.classList.remove('border-info');
  edit_btn.classList.remove('border-3');
  edit_btn.classList.remove('btn');
})
hitungBtn.addEventListener('mouseleave', function() {
  hitung_btn.classList.remove('border-info');
  hitung_btn.classList.remove('border-3');
  hitung_btn.classList.remove('btn');
  edit_btn.classList.add('border-info');
  edit_btn.classList.add('border-3');
  edit_btn.classList.add('btn');
})

const editBtn = document.querySelector('.bi-pencil-square');
const edit_btn = document.querySelector('.edit-btn');

editBtn.addEventListener('mouseover', function() {
  edit_btn.classList.add('border-info');
  edit_btn.classList.add('border-3');
  edit_btn.classList.add('btn');
})
editBtn.addEventListener('mouseleave', function() {
  edit_btn.classList.add('border-info')
  edit_btn.classList.add('border-3')
  edit_btn.classList.add('btn')
})



//Side Navbar Expand
const menuClose = document.querySelector('.closeBtn');
const menu_close = document.querySelector('.menu-close');

menuClose.addEventListener('mouseover', function() {
  menu_close.classList.add('border-info');
  menu_close.classList.add('border-3');
  menu_close.classList.add('btn');
});
menuClose.addEventListener('mouseleave', function() {
  menu_close.classList.remove('border-info');
  menu_close.classList.remove('border-3');
})
menuClose.addEventListener('click', function(){
  navExpand.classList.remove('d-block');
  navExpand.classList.add('d-none');
  sideNav.classList.remove('d-none');
  sideNav.classList.add('d-block');
})

const dashboardBtnEx = document.querySelector('.dashboardBtnEx');
const dashboard_btnEx = document.querySelector('.dashboard-btnEx');

dashboardBtnEx.addEventListener('mouseover', function() {
  dashboard_btnEx.classList.add('border-info');
  dashboard_btnEx.classList.add('border-3');
  dashboard_btnEx.classList.add('btn');
  edit_btnEx.classList.remove('border-info');
  edit_btnEx.classList.remove('border-3');
  edit_btnEx.classList.remove('btn');
})
dashboardBtnEx.addEventListener('mouseleave', function() {
  dashboard_btnEx.classList.remove('border-info');
  dashboard_btnEx.classList.remove('border-3');
  dashboard_btnEx.classList.remove('btn');
  edit_btnEx.classList.add('border-info');
  edit_btnEx.classList.add('border-3');
  edit_btnEx.classList.add('btn');
})

const hitungBtnEx = document.querySelector('.hitungBtnEx');
const hitung_btnEx = document.querySelector('.hitung-btnEx');

hitungBtnEx.addEventListener('mouseover', function() {
  hitung_btnEx.classList.add('border-info');
  hitung_btnEx.classList.add('border-3');
  hitung_btnEx.classList.add('btn');
  edit_btnEx.classList.remove('border-info');
  edit_btnEx.classList.remove('border-3');
  edit_btnEx.classList.remove('btn');
})
hitungBtnEx.addEventListener('mouseleave', function() {
  hitung_btnEx.classList.remove('border-info');
  hitung_btnEx.classList.remove('border-3');
  hitung_btnEx.classList.remove('btn');
  edit_btnEx.classList.add('border-info');
  edit_btnEx.classList.add('border-3');
  edit_btnEx.classList.add('btn');
})

const editBtnEx = document.querySelector('.editBtnEx');
const edit_btnEx = document.querySelector('.edit-btnEx');

editBtnEx.addEventListener('mouseover', function() {
  edit_btnEx.classList.add('border-info');
  edit_btnEx.classList.add('border-3');
  edit_btnEx.classList.add('btn');
})
editBtnEx.addEventListener('mouseleave', function() {
  edit_btnEx.classList.add('border-info')
  edit_btnEx.classList.add('border-3')
  edit_btnEx.classList.add('btn')
})