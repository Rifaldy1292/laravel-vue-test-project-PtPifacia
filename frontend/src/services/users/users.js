import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL;
export const getAllUsers = async (token) => {
  try {
    console.log("Fetching all users from:", `${API_URL}/all-users`); // Debugging log

    // Menggunakan token dalam header Authorization
    const response = await axios.get(`${API_URL}/all-users`, {
      headers: {
        Authorization: `Bearer ${token}`, // Menambahkan token ke header
      },
    });

    return response.data; // Mengembalikan data roles
  } catch (error) {
    console.error("Error fetching roles:", error);
    throw error; // Menangani error
  }
};
