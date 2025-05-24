var UserService = {
    init: function () {
      const token = localStorage.getItem("user_token");
      if (token && token !== undefined) {
        window.location.hash = "#home";
      }
  
      // Login forma
      $("#login-form").validate({
        submitHandler: function (form) {
          var entity = Object.fromEntries(new FormData(form).entries());
          UserService.login(entity);
        },
      });
  
      // Register forma
      $("#register-form").validate({
        submitHandler: function (form) {
          var entity = Object.fromEntries(new FormData(form).entries());
          UserService.register(entity);
        },
      });
    },
  
    login: function (entity) {
      $.ajax({
        url: Constants.PROJECT_BASE_URL + "auth/login",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          const token = result.data.token;
          localStorage.setItem("user_token", token);
          localStorage.setItem("user", JSON.stringify(Utils.parseJwt(token).user));
          toastr.success("Login successful!");
          UserService.generateMenuItems();
          window.location.hash = "#home";
        },
        error: function (xhr) {
          toastr.error(xhr?.responseText ? xhr.responseText : "Login failed");
        },
      });
    },
  
    register: function (entity) {
      $.ajax({
        url: Constants.PROJECT_BASE_URL + "auth/register",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function () {
          toastr.success("Registration successful! Please login.");
          window.location.hash = "#login";
        },
        error: function (xhr) {
          toastr.error(xhr?.responseText ? xhr.responseText : "Registration failed");
        },
      });
    },
  
    logout: function () {
      localStorage.clear();
      window.location.hash = "#login";
      $("#tabs").html(""); // očisti navbar
    },
  
    generateMenuItems: function () {
      const token = localStorage.getItem("user_token");
      const user = Utils.parseJwt(token)?.user;
  
      if (user && user.role) {
        let nav = `
          <li><a href="#home">Home</a></li>
          <li><a href="#cars-list">Cars</a></li>
          <li><a href="#rent-now">Rent</a></li>
        `;
  
        if (user.role === Constants.ADMIN_ROLE) {
          nav += `<li><a href="#dashboard">Admin</a></li>`;
        }
  
        nav += `
          <li><a href="#profile">My Profile</a></li>
          <li><button onclick="UserService.logout()" class="button small">Logout</button></li>
        `;
  
        $("#tabs").html(nav);
      } else {
        window.location.hash = "#login";
      }
    }
  };
  