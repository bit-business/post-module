<template>
  <div>
    <skijasi-breadcrumb-row> </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('edit_comments')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("comment.edit.title") }}</h3>
          </div>
          <vs-row>
            <skijasi-select
              v-model="comment.postId"
              size="12"
              :label="$t('comment.edit.field.post.title')"
              :placeholder="$t('comment.edit.field.post.placeholder')"
              :alert="errors.title"
              :items="posts"
            ></skijasi-select>
            <skijasi-textarea
              v-model="comment.content"
              size="12"
              :label="$t('comment.edit.field.comment.title')"
              :placeholder="$t('comment.edit.field.comment.placeholder')"
              :alert="errors.content"
            ></skijasi-textarea>
          </vs-row>
        </vs-card>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card class="action-card">
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button color="primary" type="relief" @click="submitForm">
                <vs-icon icon="save"></vs-icon> {{ $t("comment.edit.button") }}
              </vs-button>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "CommentEdit",
  components: {},
  data: () => ({
    errors: {},
    comment: {
      postId: "",
      content: "",
    },
    posts: []
  }),
  mounted() {
    this.getCommentDetail();
    this.getPostList();
  },
  methods: {
    getPostList() {
      this.$openLoader();
      this.$api.skijasiPost
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          if (response.data.posts) {
            this.posts = response.data.posts.map((post, index) => {
              return {
                label: post.title,
                value: post.id
              }
            });
          }
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    getCommentDetail() {
      this.$openLoader();
      this.$api.skijasiComment
        .read({
          id: this.$route.params.id,
        })
        .then((response) => {
          this.$closeLoader();
          this.comment = response.data.comment
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    submitForm() {
      this.errors = {};
      try {
        this.$openLoader();
        this.$api.skijasiComment
          .edit(this.comment)
          .then((response) => {
            this.$closeLoader();
            this.$router.push({ name: "CommentBrowse" });
          })
          .catch((error) => {
            this.errors = error.errors;
            this.$closeLoader();
            this.$vs.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          });
      } catch (error) {
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    },
  },
};
</script>
