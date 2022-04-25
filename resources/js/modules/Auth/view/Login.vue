<template>
  <section class="h-100">
    <div class="container h-100">
      <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
          <div class="text-center my-5">
            <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100" />
          </div>
          <div class="card shadow-lg">
            <div class="card-body p-5">
              <h1 class="fs-4 card-title fw-bold mb-4">Username</h1>
              <form autocomplete="off" @submit.prevent="handleSubmit" onkeydown="return event.key != 'Enter';" class="box">
                <div class="mb-3">
                  <label class="mb-2 text-muted" for="email">Username</label>
                  <input id="email" type="text" v-model="form.email" class="form-control" name="email" value="" required autofocus />
                </div>

                <div class="mb-3">
                  <div class="mb-2 w-100">
                    <label class="text-muted" for="password">Password</label>
                  </div>
                  <input id="password" type="password" v-model="form.password" class="form-control" name="password" required />
                </div>

                <div class="d-flex align-items-center">
                  <button class="btn btn-primary ms-auto" type="submit" :disabled="form.busy">Login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="text-center mt-5 text-muted">Copyright &copy; 2017-2021 &mdash; TCC Group</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Form from "vform";
import store from "~/store";
import Cookies from "js-cookie";
export default {
  name: "Login",
  middleware: "guest",
  layout: "default",
  data() {
    return {
      form: new Form({
        email: "administrator",
        password: "password",
      }),
    };
  },
  metaInfo: {
    title: "Login",
  },
  mounted() {
    localStorage.removeItem("branch");
  },
  computed: {},

  methods: {
    async handleSubmit() {
      await this.form
        .post("/api/auth/login", {
          withCredentials: true,
          credentials: "include",
        })
        .then((res) => {
          this.$store.dispatch("Auth/saveToken", {
            token: res.data,
          });
          this.$store.dispatch("Auth/fetchUser");
          this.$router
            .push({
              name: "dashboard",
            })
            .catch(() => {});
        })
        .catch((error) => {});
    },
    redirect() {
      const intendedUrl = Cookies.get("intended_url");
      if (intendedUrl) {
        Cookies.remove("intended_url");
        this.$router
          .push({
            path: intendedUrl,
          })
          .catch(() => {});
      } else {
      }
    },
  },
};
</script>
