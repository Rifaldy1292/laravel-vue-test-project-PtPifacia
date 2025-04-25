<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-900">User Accounts</h2>
      <button
        @click="openAddUserModal"
        class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-500 transition-all"
      >
        Add User
      </button>
    </div>

    <!-- Tabel User Accounts -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="bg-gray-100">
          <tr>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"
            >
              Username
            </th>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"
            >
              Email
            </th>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"
            >
              Status
            </th>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"
            >
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
            class="hover:bg-gray-50 border-t border-gray-200"
          >
            <td class="px-6 py-4 text-sm font-medium text-gray-700">
              {{ user.username }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-600">{{ user.email }}</td>
            <td class="px-6 py-4 text-sm text-gray-600">{{ user.status }}</td>
            <td class="px-6 py-4">
              <button
                @click="openEditUserModal(user)"
                class="text-yellow-600 hover:text-yellow-500 hover:bg-yellow-100 px-4 py-2 rounded-md transition-all"
              >
                Edit
              </button>
              <button
                @click="deleteUser(user.id)"
                class="ml-2 text-red-600 hover:text-red-500 hover:bg-red-100 px-4 py-2 rounded-md transition-all"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal Add User -->
    <div
      v-if="isAddUserModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Add User</h3>
        <input
          v-model="newUser.username"
          type="text"
          placeholder="Username"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
        />
        <input
          v-model="newUser.email"
          type="email"
          placeholder="Email"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
        />
        <select
          v-model="newUser.status"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
        >
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
        <div class="flex justify-end space-x-4">
          <button
            @click="closeAddUserModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="addUser"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition-all"
          >
            Add User
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Edit User -->
    <div
      v-if="isEditUserModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Edit User</h3>
        <input
          v-model="editUser.username"
          type="text"
          placeholder="Username"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
        />
        <input
          v-model="editUser.email"
          type="email"
          placeholder="Email"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
        />
        <select
          v-model="editUser.status"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
        >
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
        <div class="flex justify-end space-x-4">
          <button
            @click="closeEditUserModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="saveEditedUser"
            class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-500 transition-all"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const users = ref([
  { id: 1, username: "john_doe", email: "john@example.com", status: "Active" },
  {
    id: 2,
    username: "jane_doe",
    email: "jane@example.com",
    status: "Inactive",
  },
]);

const isAddUserModalOpen = ref(false);
const isEditUserModalOpen = ref(false);
const newUser = ref({ username: "", email: "", status: "Active" });
const editUser = ref({ username: "", email: "", status: "Active" });
const userToEdit = ref(null);

// Open Add User Modal
const openAddUserModal = () => {
  isAddUserModalOpen.value = true;
};

// Close Add User Modal
const closeAddUserModal = () => {
  isAddUserModalOpen.value = false;
  newUser.value = { username: "", email: "", status: "Active" };
};

// Add New User
const addUser = () => {
  if (newUser.value.username && newUser.value.email) {
    const newId = users.value.length + 1;
    users.value.push({ ...newUser.value, id: newId });
    closeAddUserModal();
  }
};

// Open Edit User Modal
const openEditUserModal = (user) => {
  userToEdit.value = user;
  editUser.value = { ...user };
  isEditUserModalOpen.value = true;
};

// Close Edit User Modal
const closeEditUserModal = () => {
  isEditUserModalOpen.value = false;
  userToEdit.value = null;
  editUser.value = { username: "", email: "", status: "Active" };
};

// Save Edited User
const saveEditedUser = () => {
  if (editUser.value.username && editUser.value.email) {
    const index = users.value.findIndex(
      (user) => user.id === userToEdit.value.id
    );
    if (index !== -1) {
      users.value[index] = { ...editUser.value };
      closeEditUserModal();
    }
  }
};

// Delete User
const deleteUser = (id) => {
  const index = users.value.findIndex((user) => user.id === id);
  if (index !== -1) {
    users.value.splice(index, 1);
  }
};
</script>

<style scoped>
/* Additional custom styles for modal background */
.fixed {
  z-index: 50;
}
</style>
