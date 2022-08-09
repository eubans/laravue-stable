import { change } from '@/api/password';
import { isLogged } from '@/utils/auth';
import { Message } from 'element-ui';

const state = {
  id: null,
  user: null,
  token: isLogged(),
  name: '',
  avatar: '',
  introduction: '',
  roles: [],
  permissions: [],
};

const actions = {
  // user login
  change({ commit }, passwordInfo) {
    const { id, currentPassword, newPassword, confirmNewPassword } = passwordInfo;
    return new Promise((resolve, reject) => {
      change(id, { current_password: currentPassword, new_password: newPassword, confirm_password: confirmNewPassword })
        .then(response => {
          Message({
            message: 'Permissions has been updated successfully',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
        });
    });
  },
};

export default {
  namespaced: true,
  state,
  actions,
};
