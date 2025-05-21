import axios from "axios";

const API_URL = "http://127.0.0.1:8000/api";

const axiosInstance = axios.create({
  baseURL: API_URL,
  headers: {
    "Content-Type": "application/json",
  },
});

export const login = async (email, password) => {
  try {
    const response = await axiosInstance.post("/login", { email, password });
    return response.data;
  } catch (error) {
    // Menyediakan detail kesalahan lebih informatif
    if (error.response) {
      // Jika error berasal dari server (misalnya 400, 401, dll)
      throw new Error(error.response.data.message || "Login failed");
    } else {
      // Jika terjadi kesalahan lain (misalnya masalah jaringan)
      throw new Error("Network error or server not reachable");
    }
  }
};

export const register = async (username, email, password) => {
  try {
    const response = await axiosInstance.post("/register", {
      username,
      email,
      password,
    });
    return response.data;
  } catch (error) {
    // Menyediakan detail kesalahan lebih informatif
    if (error.response) {
      throw new Error(error.response.data.message || "Registration failed");
    } else {
      throw new Error("Network error or server not reachable");
    }
  }
};
