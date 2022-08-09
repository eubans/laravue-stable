import request from '@/utils/request';

export function change(id, data) {
  return request({
    url: '/password/change/' + id,
    method: 'put',
    data: data,
  });
}
