<template>
  <div>
    <skijasi-breadcrumb-row> </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('edit_posts')">
      <vs-col vs-lg="12">
        <vs-row>
          <vs-col vs-lg="8" class="pl-0 pt-0">
            <skijasi-collapse type="margin" class="p-0">
              <skijasi-collapse-item open style="background: #fff; margin-bottom: 30px" class="mt-0" ref="postContent">
                <h3 slot="header">{{ $t("posts.edit.title") }}</h3>

                <vs-row>
  
      <!-- Croatian (Default) -->
      <skijasi-text
        v-model="post.title"
        size="12"
        :label="$t('posts.edit.field.title.title') + ' (HR)'"
        :placeholder="$t('posts.edit.field.title.placeholder')"
        :alert="errors.title"
      ></skijasi-text>
      
      <!-- English -->
      <skijasi-text
        v-model="post.title_en"
        size="12"
        :label="$t('posts.edit.field.title.title') + ' (EN)'"
        :placeholder="$t('posts.edit.field.title.placeholder')"
        :alert="errors.title_en"
      ></skijasi-text>
      
      <!-- Italian -->
      <skijasi-text
        v-model="post.title_it"
        size="12"
        :label="$t('posts.edit.field.title.title') + ' (IT)'"
        :placeholder="$t('posts.edit.field.title.placeholder')"
        :alert="errors.title_it"
      ></skijasi-text>

      <!-- Croatian Content (Default) -->
      <skijasi-editor
        v-model="post.content"
        size="12"
        :label="$t('posts.edit.field.content.title') + ' (HR)'"
        :placeholder="$t('posts.edit.field.content.placeholder')"
        :alert="errors.content"
          editorId="content-hr"
      ></skijasi-editor>

      <!-- English Content -->
      <skijasi-editor
        v-model="post.content_en"
        size="12"
        :label="$t('posts.edit.field.content.title') + ' (EN)'"
        :placeholder="$t('posts.edit.field.content.placeholder')"
        :alert="errors.content_en"
          editorId="content-en"
      ></skijasi-editor>

      <!-- Italian Content -->
      <skijasi-editor
        v-model="post.content_it"
        size="12"
        :label="$t('posts.edit.field.content.title') + ' (IT)'"
        :placeholder="$t('posts.edit.field.content.placeholder')"
        :alert="errors.content_it"
          editorId="content-it"
      ></skijasi-editor>

                </vs-row>
              </skijasi-collapse-item>

              <!--
              <skijasi-collapse-item style="background: #fff;">
                <h3 slot="header">{{ $t("posts.edit.seo") }}</h3>
                <vs-row>
                  <skijasi-text
                    v-model="post.metaTitle"
                    size="12"
                    :label="$t('posts.edit.field.metaTitle.title')"
                    :placeholder="$t('posts.edit.field.metaTitle.placeholder')"
                    :alert="errors.metaTitle"
                  ></skijasi-text>
                  <skijasi-text
                    v-model="post.metaDescription"
                    size="12"
                    :label="$t('posts.edit.field.metaDescription.title')"
                    :placeholder="$t('posts.edit.field.metaDescription.placeholder')"
                    :alert="errors.metaTitle"
                  ></skijasi-text>
                  <skijasi-textarea
                    v-model="post.summary"
                    size="12"
                    :label="$t('posts.edit.field.summary.title')"
                    :placeholder="$t('posts.edit.field.summary.placeholder')"
                    :alert="errors.summary"
                  ></skijasi-textarea>
                </vs-row>
              </skijasi-collapse-item>

            -->
            </skijasi-collapse>
          </vs-col>
          <vs-col vs-lg="4" class="pr-0">
            <skijasi-collapse type="margin" class="p-0">
              <skijasi-collapse-item open style="background: #fff; margin-bottom: 30px" class="mt-0">
                <h3 slot="header">{{ $t("posts.edit.publish") }}</h3>
                <vs-row>
                  <skijasi-text
                    v-model="post.slug"
                    size="12"
                    :label="$t('posts.edit.field.slug.title')"
                    :placeholder="$t('posts.edit.field.slug.placeholder')"
                    :alert="errors.slug"
                    disabled
                  ></skijasi-text>
                  <skijasi-switch
                    v-model="post.published"
                    size="12"
                    :label="$t('posts.edit.field.published.title')"
                    :placeholder="$t('posts.edit.field.published.placeholder')"
                    :alert="errors.published"
                  ></skijasi-switch>

                  <skijasi-date
                    v-model="post.published_at"
                    size="8"
                    :label="$t('Datum objave (opcionalno)')"
                    :placeholder="$t('Datum objave')"
                    :alert="errors.published_at"
                  ></skijasi-date>

                </vs-row>
              </skijasi-collapse-item>

<!--
              <skijasi-collapse-item open style="background: #fff;">
                <h3 slot="header">{{ $t("posts.edit.categoryAndTags") }}</h3>
                <vs-row>
                  <skijasi-select
                    v-model="post.category"
                    size="12"
                    :label="$t('posts.edit.field.category.title')"
                    :placeholder="$t('posts.edit.field.category.placeholder')"
                    :alert="errors.category"
                    :items="categories"
                  ></skijasi-select>
                  <skijasi-select-multiple
                    v-model="post.tags"
                    size="12"
                    :label="$t('posts.edit.field.tags.title')"
                    :placeholder="$t('posts.edit.field.tags.placeholder')"
                    :alert="errors.tags"
                    :items="tags"
                  ></skijasi-select-multiple>
                </vs-row>
              </skijasi-collapse-item>

            -->
              <skijasi-collapse-item open style="background: #fff;">
                <h3 slot="header">{{ $t("posts.add.featuredImage") }}</h3>
                <vs-row class="mb-0">
                  <skijasi-upload-image-vijesti
                    v-model="post.thumbnail"
                    size="12"
                    :label="$t('posts.add.field.featured.title')"
                    :placeholder="$t('posts.add.field.featured.placeholder')"
                    :alert="errors.thumbnail"
                  ></skijasi-upload-image-vijesti>
                  <skijasi-text
                    v-model="post.link"
                    size="12"
                    :label="$t('Link na koji vodi članak')"
                    :placeholder="$t('')"
                    :alert="errors.link"
                  ></skijasi-text>
                </vs-row>
              </skijasi-collapse-item>
            </skijasi-collapse>
          </vs-col>
        </vs-row>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card class="action-card">
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button color="primary" type="relief" @click="submitForm">
                <vs-icon icon="save"></vs-icon> {{ $t("posts.edit.button") }}
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
  name: "PostsEdit",
  components: {},
  data: () => ({
    errors: {},
    post: {
      title: "",
      metaTitle: "",
      slug: "",
      link: "",

      title_en: "",
      title_it: "",
      content_en: "",
      content_it: "",

      published_at: null,

      content: "",
      summary: "",
      published: true,
      tags: [],
      category: "",
      commentCount: 0,
      thumbnail: ""
    },
    categories: [],
    tags: [],
    meta: {}
  }),
  mounted() {
    this.getPosts();
    this.getCategory();
    this.getTags();
  },
  methods: {
    syncSlug() {
      let kebab = this.$helper.generateSlug(this.post.title).replaceAll("'", "");
      this.post.slug = kebab
    },
    getPosts() {
  this.$openLoader();
  this.$api.skijasiPost
    .read({
      id: this.$route.params.id,
    })
    .then((response) => {
      this.$closeLoader();
      
      const postData = response.data.post;
      
      // Map the camelCase fields to underscore fields
      this.post = {
        id: postData.id,
        title: postData.title,
        title_en: postData.titleEn || '', // Changed from title_en to titleEn
        title_it: postData.titleIt || '', // Changed from title_it to titleIt
        content: postData.content,
        content_en: postData.contentEn || '', // Changed from content_en to contentEn
        content_it: postData.contentIt || '', // Changed from content_it to contentIt
        link: postData.link,
        slug: postData.slug,
        metaTitle: postData.meta_title,
        metaDescription: postData.meta_description,
        thumbnail: postData.thumbnail,
        published: postData.published === 1,
        published_at: postData.published_at,
        category: postData.category ? postData.category.id : "",
        tags: postData.tags && postData.tags.length > 0 
          ? postData.tags.map(tag => tag.id)
          : [],
        commentCount: postData.comment_count || 0
      };

      console.log('Final post object after mapping:', this.post);
    })
    .catch((error) => {
      console.error('Error loading post:', error);
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
    
    // Convert fields to match API expectations
    const postData = {
      ...this.post,
      titleEn: this.post.title_en,
      titleIt: this.post.title_it,
      contentEn: this.post.content_en,
      contentIt: this.post.content_it,
    };

    this.$api.skijasiPost
      .edit(postData)
      .then((response) => {
        this.$closeLoader();
        this.$router.push({ name: "PostsBrowse" });
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
    getCategory() {
      this.$openLoader();
      this.$api.skijasiCategory
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.categories = response.data.categories.map((category, index) => {
            return {
              label: category.title,
              value: category.id
            }
          });
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
    getTags() {
      this.$openLoader();
      this.$api.skijasiTags
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.tags = response.data.tags.map((tag, index) => {
            return {
              label: tag.title,
              value: tag.id
            }
          })
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    }
  },
};
</script>
<style>
.vs-collapse-item--content {
  cursor: default !important;
}

.ql-container {
  cursor: text !important;
}
</style>