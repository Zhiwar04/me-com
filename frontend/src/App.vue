<template>
  <router-view></router-view>
</template>
<style>
.form-group {
  margin-bottom: 1rem;
}
.form-group input {
  background: #fff;
  border: 1px solid #ececec;
  height: 40px;
  box-shadow: none;
  padding-left: 20px;
  font-size: 16px;
  width: 100%;
  margin: 4px 0 20px;
}
.form-group input:focus {
  background: transparent;
  border-color: #bce3c9;
}

label {
  margin-bottom: 5px;
}

.custome-radio .form-check-label,
.custome-checkbox .form-check-label {
  position: relative;
  cursor: pointer;
}

.custome-checkbox .form-check-label {
  position: relative;
  cursor: pointer;
  color: #687188;
  padding: 0;
  vertical-align: middle;
}
.custome-checkbox .form-check-label::before {
  content: "";
  border: 2px solid #ced4da;
  height: 17px;
  width: 17px;
  margin: 0px 8px 0 0;
  display: inline-block;
  vertical-align: middle;
  border-radius: 2px;
}
.custome-checkbox .form-check-label span {
  vertical-align: middle;
}
.custome-checkbox input[type="checkbox"]:checked + .form-check-label::after {
  opacity: 1;
}
.custome-checkbox input[type="checkbox"] + .form-check-label::after {
  content: "";
  width: 11px;
  position: absolute;
  top: 50%;
  left: 3px;
  opacity: 0;
  height: 6px;
  border-left: 2px solid #fff;
  border-bottom: 2px solid #fff;
  transform: translateY(-65%) rotate(-45deg);
}

.custome-radio .form-check-input,
.custome-checkbox .form-check-input {
  display: none;
}

.login_footer {
  margin-bottom: 20px;
  margin-top: 5px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.custome-checkbox input[type="checkbox"]:checked + .form-check-label::before {
  background-color: #dc3545;
  border-color: #dc3545;
}
.custome-checkbox input[type="checkbox"]:checked + .form-check-label::after {
  opacity: 1;
}

.btn-heading,
button.btn-heading[type="submit"] {
  background-color: #253d4e;
  border-color: #253d4e;
  font-weight: 700;
  border: 0;
}

button.submit,
button[type="submit"] {
  font-size: 16px;
  font-weight: 500;
  padding: 15px 40px;
  color: #ffffff;
  border: none;
  background-color: #dc3545;
  border: 1px solid #ff1229;
  border-radius: 10px;
}
button.submit:hover,
button[type="submit"]:hover {
  background-color: #ff1229 !important;
}

.btn-brand:hover {
  background-color: #ff1229 !important;
}

.btn-login {
  font-weight: 13px;
}
.btn-login .btn {
  min-width: unset;
}
.btn-login li {
  margin: 0px 5px 0;
  display: inline-block;
}
.btn-login li a {
  border-radius: 5px;
  padding: 15px 25px;
  color: #fff;
  display: block;
  line-height: 1;
  text-transform: none;
  letter-spacing: 0;
  font-size: 14px;
}

.btn,
.button {
  display: inline-block;
  border: 1px solid transparent;
  font-size: 14px;
  font-weight: 700;
  padding: 12px 30px;
  border-radius: 4px;
  color: #fff;
  border: 1px solid transparent;
  background-color: #dc3545;
  cursor: pointer;
  transition: all 300ms linear 0s;
  letter-spacing: 0.5px;
}
</style>
