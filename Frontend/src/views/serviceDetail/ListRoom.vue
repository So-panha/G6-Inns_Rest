<template>
  <div>
    <CardDetail :ListImages="ListImages"/>
  </div>
</template>

<script>
import CardDetail from "./CardDetail.vue";

export default {
  name: "ListRoom",
  components: {
    CardDetail
  },
  data() {
    return {
      ListImages: [
        {
          id: "1",
          images:[
            'https://cdn.pixabay.com/photo/2016/11/18/13/02/bed-1834327_640.jpg',
            'https://cdn.pixabay.com/photo/2021/11/08/00/30/bedroom-6778193_640.jpg',
            'https://cdn.pixabay.com/photo/2018/06/14/21/15/bedroom-3475656_640.jpg',
            'https://cdn.pixabay.com/photo/2020/11/24/11/36/bedroom-5772286_1280.jpg'
          ]
        },
        {
          id: "2",
           images:[
             'https://cdn.pixabay.com/photo/2021/08/27/01/33/bedroom-6577523_640.jpg',
             'https://cdn.pixabay.com/photo/2017/01/28/08/13/master-bedroom-2014865_640.jpg',
             'https://cdn.pixabay.com/photo/2017/08/05/22/08/bed-2586034_640.jpg',
             'https://cdn.pixabay.com/photo/2018/07/14/17/19/interior-3538020_640.jpg'
           ]
        },
        {
          id: "3",
           images:[
             "https://cdn.pixabay.com/photo/2020/10/18/09/16/bedroom-5664221_640.jpg",
             "https://cdn.pixabay.com/photo/2016/02/22/09/03/double-bed-1215004_640.jpg",
             "https://cdn.pixabay.com/photo/2017/01/09/12/08/room-1966383_640.jpg",
             "https://cdn.pixabay.com/photo/2016/08/16/03/56/bedroom-1597103_640.jpg"
           ]
        },
        {
          id: "4",
           images:[
             "https://cdn.pixabay.com/photo/2021/11/08/00/30/bedroom-6778193_640.jpg",
             "https://cdn.pixabay.com/photo/2016/12/08/03/53/pillow-1890940_640.jpg",
             "https://cdn.pixabay.com/photo/2016/12/30/07/55/bedroom-1940168_640.jpg",
             "https://cdn.pixabay.com/photo/2017/05/05/23/43/bedroom-2288559_640.jpg"
           ]
        }
      ]
    };
  }
};
</script>

<style>
/* Add your component-specific styles here if needed */
</style>
