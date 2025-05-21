// src/services/roleService.js

import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL; // Ganti dengan URL API Anda

// Fungsi untuk mendapatkan data roles
export const getAllRoles = async (token) => {
  try {
    console.log("Fetching all roles from:", `${API_URL}/all-role`); // Debugging log

    // Menggunakan token dalam header Authorization
    const response = await axios.get(`${API_URL}/all-role`, {
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

export const createRole = async (data, token) => {
  try {
    const response = await axios.post(
      `${API_URL}/new-role`, // URL API untuk membuat role baru
      data,
      {
        headers: {
          Authorization: `Bearer ${token}`,
          "Content-Type": "application/json",
        },
      }
    );
    return response.data; // Mengembalikan response dari server
  } catch (error) {
    console.error("Error creating role:", error);
    throw error; // Menangani error jika ada
  }
};

// export const deleteRole = async (roleName, isActive, description, token) => {
//   try {
//     const response = await axios.post(
//       `${API_URL}/new-role`, // URL API untuk membuat role baru
//       {
//         name: roleName, // Nama role
//         is_active: isActive, // Status aktif role
//         description: description, // Deskripsi dalam bentuk JSON
//       },
//       {
//         headers: {
//           Authorization: `Bearer ${token}`,
//           "Content-Type": "application/json",
//         },
//       }
//     );
//     return response.data; // Mengembalikan response dari server
//   } catch (error) {
//     console.error("Error creating role:", error);
//     throw error; // Menangani error jika ada
//   }
// };

export async function deleteRole(id, token) {
  return axios.delete(`${API_URL}/delete-role/${id}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
}

export const updateRole = async (id, data, token) => {
  try {
    // Debugging log
    const response = await axios.put(
      `${API_URL}/edit-role/${id}`, // URL API untuk mengedit role berdasarkan ID
      data,
      {
        headers: {
          Authorization: `Bearer ${token}`,
          "Content-Type": "application/json",
        },
      }
    );
    return response.data; // Mengembalikan response dari server
  } catch (error) {
    console.error("Error editing role:", error);
    throw error; // Menangani error jika ada
  }
};
