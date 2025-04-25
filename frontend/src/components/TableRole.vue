<template>
  <div class="container mx-auto px-4 py-8">
    <!-- Header dan Tombol Add Role -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-900">Role Management</h2>
      <button
        @click="openAddRoleModal"
        class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-500 transition-all"
      >
        Add Role
      </button>
    </div>

    <!-- Tabel Role Management -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="bg-gray-100">
          <tr>
            <th
              class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider"
            >
              Role
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
            v-for="role in roles"
            :key="role.id"
            class="hover:bg-gray-50 border-t border-gray-200"
          >
            <td class="px-6 py-4 text-sm font-medium text-gray-700">
              {{ role.name }}
            </td>
            <td class="px-6 py-4">
              <button
                @click="openEditRoleModal(role)"
                class="text-yellow-600 hover:text-yellow-500 hover:bg-yellow-100 px-4 py-2 rounded-md transition-all"
              >
                Edit
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal Add Role -->
    <div
      v-if="isAddRoleModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Add Role</h3>
        <input
          type="text"
          v-model="newRoleName"
          placeholder="Role Name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 mb-4"
        />
        <div class="flex justify-end space-x-4">
          <button
            @click="closeAddRoleModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="addRole"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition-all"
          >
            Add
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Edit Role -->
    <div
      v-if="isEditRoleModalOpen"
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Edit Role</h3>
        <input
          type="text"
          v-model="editedRoleName"
          placeholder="Role Name"
          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600 mb-4"
        />
        <div class="flex justify-end space-x-4">
          <button
            @click="closeEditRoleModal"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-400 transition-all"
          >
            Cancel
          </button>
          <button
            @click="saveEditedRole"
            class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-500 transition-all"
          >
            Save
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const roles = ref([
  { id: 1, name: "Admin" },
  { id: 2, name: "User" },
]);

const isAddRoleModalOpen = ref(false);
const isEditRoleModalOpen = ref(false);
const newRoleName = ref("");
const editedRoleName = ref("");
const roleToEdit = ref(null);

// Function to open the "Add Role" modal
const openAddRoleModal = () => {
  isAddRoleModalOpen.value = true;
};

// Function to close the "Add Role" modal
const closeAddRoleModal = () => {
  isAddRoleModalOpen.value = false;
  newRoleName.value = "";
};

// Function to add a new role
const addRole = () => {
  if (newRoleName.value) {
    const newRole = {
      id: roles.value.length + 1,
      name: newRoleName.value,
    };
    roles.value.push(newRole);
    closeAddRoleModal();
  }
};

// Function to open the "Edit Role" modal with the selected role data
const openEditRoleModal = (role) => {
  roleToEdit.value = role;
  editedRoleName.value = role.name;
  isEditRoleModalOpen.value = true;
};

// Function to close the "Edit Role" modal
const closeEditRoleModal = () => {
  isEditRoleModalOpen.value = false;
  roleToEdit.value = null;
  editedRoleName.value = "";
};

// Function to save the edited role
const saveEditedRole = () => {
  if (editedRoleName.value) {
    roleToEdit.value.name = editedRoleName.value;
    closeEditRoleModal();
  }
};
</script>

<style scoped>
/* Additional custom styles for modal background */
.fixed {
  z-index: 50;
}
</style>
