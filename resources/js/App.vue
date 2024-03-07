<template>
  <div class="container">
    <div v-if="!loggedIn && !showRegister" class="auth-container">
      <div>
        <div>
          <h2>Login</h2>
          <form @submit.prevent="login">
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="loginEmail" required />

            <label for="password">Password:</label>
            <input type="password" id="password" v-model="loginPassword" required />

            <button type="submit">Login</button>
          </form>
          <button @click="toggleForm">Switch to Register</button>
        </div>
      </div>
    </div>

    <div v-if="!loggedIn && showRegister" class="auth-container">
      <div>
        <div>
          <h2>Register</h2>
          <form @submit.prevent="register">
            <label for="registerName">Name:</label>
            <input type="text" id="registerName" v-model="registerName" required />

            <label for="registerEmail">Email:</label>
            <input type="email" id="registerEmail" v-model="registerEmail" required />

            <label for="registerPassword">Password:</label>
            <input type="password" id="registerPassword" v-model="registerPassword" required />

            <button type="submit">Register</button>
          </form>
          <button @click="toggleForm">Switch to Login</button>
        </div>
      </div>
    </div>

    <div v-if="loggedIn" class="user-container">
      <p>Welcome, {{ loginEmail }}!</p>
      <button @click="logout">Logout</button>
      <div>
        <p>User Cash: {{ userCash }}</p>
      </div>
      <div>
        <h2>Available Vehicles</h2>
        <ul class="vehicle-list">
          <li v-for="vehicle in vehicles" :key="vehicle.name" class="vehicle-item">
            <span class="vehicle-name">{{ vehicle.vehname }}</span>
            <span class="vehicle-cost">Cost: {{ vehicle.vehiclecost }}</span>
            <button @click="buyVehicle(vehicle)">Buy</button>
          </li>
        </ul>
      </div>
      <div>
        <h2>User Vehicles</h2>
        <ul class="user-vehicle-list">
          <li v-for="vehicle in userVehicles" :key="vehicle.id" class="user-vehicle-item">
            <span class="vehicle-name">{{ vehicle.vehname }}</span>
            <span class="vehicle-cost">Cost: {{ vehicle.vehiclecost }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      loginEmail: "",
      loginPassword: "",
      registerName: "",
      registerEmail: "",
      registerPassword: "",
      loggedIn: false,
      userCash: 0,
      vehicles: [],
      userVehicles: [],
      showRegister: false,
    };
  },
  mounted() {
    this.fetchVehicles();
    this.checkLoginStatus();
  },
  methods: {
    login() {
      const formData = {
        email: this.loginEmail,
        password: this.loginPassword,
      };
      this.authenticateUser("login", formData);
    },

    register() {
      const formData = {
        name: this.registerName,
        email: this.registerEmail,
        password: this.registerPassword,
      };
      this.authenticateUser("register", formData);
    },

    authenticateUser(route, formData) {
      const apiUrl = `http://127.0.0.1:8000/api/${route}`;

      axios
        .post(apiUrl, formData)
        .then((response) => {
          const token = response.data.token;
          localStorage.setItem("token", token);
          this.loggedIn = true;
          this.fetchUserCash();
          this.fetchVehicles();
          if (route === "login") {
            this.fetchUserVehicles();
          }
        })
        .catch((error) => {
          console.error(`${route} failed:`, error);
        });
    },

    fetchUserVehicles() {
      this.fetchData("/api/user/vehicles", "userVehicles");
    },

    fetchVehicles() {
      this.fetchData("/api/vehicle", "vehicles");
    },

    fetchData(apiUrl, dataProperty) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;

      axios
        .get(apiUrl)
        .then((response) => {
          if (response.data && response.data.data !== undefined) {
            this[dataProperty] = response.data.data;
          } else {
            console.error("Invalid response format:", response);
          }
        })
        .catch((error) => {
          console.error(`Failed to fetch ${dataProperty}:`, error);
        });
    },

    fetchUserCash() {
      this.fetchData("/api/user/cash", "userCash");
    },

    removeUserCash(amount) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;

      axios
        .post("/api/user/remove-cash", { amount })
        .then(() => {
          this.fetchUserCash();
          console.log("Cash removed successfully!");
        })
        .catch((error) => {
          console.error("Failed to remove cash:", error);
        });
    },

    buyVehicle(vehicle) {
      axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;

      if (this.userCash >= vehicle.vehiclecost) {
        axios
          .post("/api/user/buy-vehicle", {
            vehname: vehicle.vehname,
            vehiclecost: vehicle.vehiclecost,
          })
          .then(() => {
            this.removeUserCash(vehicle.vehiclecost);
            this.fetchUserVehicles();
            console.log("Vehicle bought successfully!");
          })
          .catch((error) => {
            if (error.response && error.response.status === 401) {
              console.error("Unauthorized: Please log in.");
            } else {
              console.error("Failed to buy the vehicle:", error);
            }
          });
      } else {
        console.log("Not enough cash to buy the vehicle");
      }
    },

    toggleForm() {
      this.showRegister = !this.showRegister;
      this.resetFormFields();
    },

    resetFormFields() {
      if (this.showRegister) {
        this.loginEmail = "";
        this.loginPassword = "";
      } else {
        this.registerName = "";
        this.registerEmail = "";
        this.registerPassword = "";
      }
    },

    checkLoginStatus() {
      const token = localStorage.getItem("token");
      if (token) {
        this.loggedIn = true;
        this.fetchUserCash();
        this.fetchVehicles();
        this.fetchUserVehicles();
      }
    },

    logout() {
      localStorage.removeItem("token");
      this.loggedIn = false;
      this.loginEmail = "";
      this.loginPassword = "";
      this.registerName = "";
      this.registerEmail = "";
      this.registerPassword = "";
      this.userCash = 0;
      this.vehicles = [];
      this.userVehicles = [];
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.auth-container,
.user-container {
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.auth-container {
  background-color: #f5f5f5;
}

.user-container {
  background-color: #e0f7fa;
}

form {
  margin-top: 10px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.vehicle-list,
.user-vehicle-list {
  list-style-type: none;
  padding: 0;
}

.vehicle-item,
.user-vehicle-item {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 10px;
  margin-bottom: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.vehicle-name {
  font-weight: bold;
}

.vehicle-cost {
  color: #4caf50;
}
</style>
