<template>
  <main>
    <div class="d-flex justify-content-center my-3">
      <p class="btn btn-danger btn-sm me-3" @click="goHome()">Home</p>
      <p class="btn btn-dark btn-sm me-3" @click="goLogin()" v-if="!storageStatus">Login</p>
      <p class="btn btn-dark btn-sm me-3" @click="goLogout()" v-if="storageStatus">Logout</p>
    </div>
    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row d-flex justify-content-between">
              <div class="col-lg-3 col-md-3">
                <div class="section-tittle mb-30">
                  <h3>Whats New </h3>
                </div>
              </div>
              <div class="col-lg-9 col-md-9">
                <div class="properties__button">
                  <!--Nav Button  -->
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a
                        class="nav-item nav-link active"
                        id="nav-home-tab"
                        data-toggle="tab"
                        href="#"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                        @click="searchCategory('')"
                        >All</a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-profile-tab"
                        data-toggle="tab"
                        href="#"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"
                        v-for="(category, index) in categoryLists"
                        :key="index"
                        @click="searchCategory(category.category_id)"
                        >{{ category.title }}</a
                      >
                    </div>
                  </nav>
                  <!--End Nav Button  -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-3">
                <div class="d-flex justify-content-end">
                  <input
                    type="text"
                    v-model="searchKey"
                    v-on:keyup.enter="searchData"
                  />
                  <button @click="searchData">
                    <i class="fa fa-solid fa-search text-dark"></i>
                  </button>
                </div>
              </div>

              <div class="col-12">
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                  <!-- card one -->
                  <div
                    class="tab-pane fade show active"
                    id="nav-home"
                    role="tabpanel"
                    aria-labelledby="nav-home-tab"
                  >
                    <div class="whats-news-caption">
                      <div class="row p-5" v-if="!storageStatus">
                        <h1 class="d-flex justify-content-center h3 bg-warning  mx-auto p-3">
                          There is no permission for this page. Please Login
                          First!
                        </h1>
                      </div>

                      <div class="row" v-if="storageStatus">
                        <div
                          class="row text-center"
                          style="height: 75vh"
                          v-if="postLists.length == 0"
                        >
                          <h1 class="text-danger mt-5">There is no data!</h1>
                        </div>

                        <div class="row" v-else-if="postLists.length != 0">
                          <div
                            class="col-lg-6 col-md-6"
                            v-for="(post, index) in postLists"
                            :key="index"
                          >
                            <div
                              class="single-what-news mb-100"
                              @click="details(post.post_id)"
                            >
                              <div class="what-img">
                                <img v-bind:src="post.image" alt="" />
                              </div>
                              <div class="what-cap">
                                <span class="color1">Code Lab News</span>
                                <h4>
                                  <a href="details.html">{{ post.title }}</a>
                                </h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Nav Card -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Whats New End -->

    <!--Start pagination -->
    <!-- <div class="pagination-area pb-45 text-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="single-wrap d-flex justify-content-center">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-start">
                  <li class="page-item">
                    <a class="page-link" href="details.html"
                      ><span class="flaticon-arrow roted"></span
                    ></a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="details.html">01</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="details.html">02</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="details.html">03</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="details.html"
                      ><span class="flaticon-arrow right-arrow"></span
                    ></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- End pagination  -->
  </main>
</template>

<script src = "../js/HomePage.js"></script>


