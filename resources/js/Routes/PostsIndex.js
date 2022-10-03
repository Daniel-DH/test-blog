import Posts from '../Posts/Posts.vue'
import MyPosts from '../Posts/MyPosts.vue'
import PostsShow from '../Posts/PostsShow.vue'
import PostsCreate from '../Posts/PostsCreate.vue'
import PostEdit from '../Posts/PostEdit.vue'

const PostIndex = [
    {
        path:'',
        name:'Posts',
        component: Posts
      },
      {
        path:'myPosts',
        name:'MyPosts',
        component: MyPosts
      },
      {
        path:'create',
        name:'PostsCreate',
        component: PostsCreate
      },
      {
        path: ':PostId',
        name: 'PostsShow',
        component: PostsShow
      },
      {
        path: ':PostId/edit',
        name: 'PostsEdit',
        component: PostEdit
      }
];

export default PostIndex;
