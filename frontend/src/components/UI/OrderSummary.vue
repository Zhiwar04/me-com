<template>
  <div class="d-flex align-items-center">
    <div>
      <h5 class="mb-0">Orders Summary</h5>
    </div>
    <div class="font-22 ms-auto">
      <i class="bx bx-dots-horizontal-rounded"></i>
    </div>
  </div>
  <hr />
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Order id</th>
          <th>Product</th>
          <th>Customer</th>
          <th>Date</th>
          <th>Price</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#897656</td>
          <td>
            <div class="d-flex align-items-center">
              <div class="recent-product-img">
                <img
                  src="../../../public/assets/images/avatars/avatar-1.png"
                  alt=""
                />
              </div>
              <div class="ms-2">
                <h6 class="mb-1 font-14">Light Blue Chair</h6>
              </div>
            </div>
          </td>
          <td>Brooklyn Zeo</td>
          <td>12 Jul 2020</td>
          <td>$64.00</td>
          <td>
            <div class="badge rounded-pill bg-light-info text-info w-100">
              In Progress
            </div>
          </td>
          <td>
            <div class="d-flex order-actions">
              <a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
              <a href="javascript:;" class="ms-4"
                ><i class="bx bx-down-arrow-alt"></i
              ></a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
