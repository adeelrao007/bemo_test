import Vue from 'vue'
import { getColumns } from './apis.js';
export default Vue.observable({
  columns: getColumns(),
})