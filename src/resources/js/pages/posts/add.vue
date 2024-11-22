<template>
  <div>
    <skijasi-breadcrumb-row> </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('add_posts')">
      <vs-col vs-lg="12">
        <vs-row>
          <vs-col vs-lg="8" class="pl-0 pt-0">
            <skijasi-collapse type="margin" class="p-0">
              <skijasi-collapse-item open style="background: #fff; margin-bottom: 30px" class="mt-0" ref="postContent">
                <h3 slot="header">{{ $t("posts.add.title") }}</h3>

                <vs-row>
                  <!-- Croatian (Default) -->
                  <skijasi-text
                    v-model="post.title"
                    size="12"
                    :label="$t('posts.add.field.title.title') + ' (HR)'"
                    :placeholder="$t('posts.add.field.title.placeholder')"
                    :alert="errors.title"
                    @input="syncSlug()"
            
                  ></skijasi-text>
                  
                  <!-- English -->
                  <skijasi-text
                    v-model="post.title_en"
                    size="12"
                    :label="$t('posts.add.field.title.title') + ' (EN)'"
                    :placeholder="$t('posts.add.field.title.placeholder')"
                    :alert="errors.title_en"
   
                  ></skijasi-text>
                  
                  <!-- Italian -->
                  <skijasi-text
                    v-model="post.title_it"
                    size="12"
                    :label="$t('posts.add.field.title.title') + ' (IT)'"
                    :placeholder="$t('posts.add.field.title.placeholder')"
                    :alert="errors.title_it"
      
                  ></skijasi-text>

                  <skijasi-editor
  v-model="post.content"
  size="12"
  :label="$t('posts.edit.field.content.title') + ' (HR)'"
  :placeholder="$t('posts.edit.field.content.placeholder')"
  :alert="errors.content"
  editorId="content-hr"
></skijasi-editor>

<!-- For English Content -->
<skijasi-editor
  v-model="post.content_en"
  size="12"
  :label="$t('posts.edit.field.content.title') + ' (EN)'"
  :placeholder="$t('posts.edit.field.content.placeholder')"
  :alert="errors.content_en"
  editorId="content-en"
></skijasi-editor>

<!-- For Italian Content -->
<skijasi-editor
  v-model="post.content_it"
  size="12"
  :label="$t('posts.edit.field.content.title') + ' (IT)'"
  :placeholder="$t('posts.edit.field.content.placeholder')"
  :alert="errors.content_it"
  editorId="content-it"
></skijasi-editor>
                  <!-- <skijasi-textarea
                    v-model="post.summary"
                    size="12"
                    :label="$t('posts.add.field.summary.title')"
                    :placeholder="$t('posts.add.field.summary.placeholder')"
                    :alert="errors.summary"
                  ></skijasi-textarea> -->
                </vs-row>
              </skijasi-collapse-item>
              <skijasi-collapse-item style="background: #fff;">
                <h3 slot="header">{{ $t("posts.add.seo") }}</h3>
                <vs-row>
                  <skijasi-text
                    v-model="post.metaTitle"
                    size="12"
                    :label="$t('posts.add.field.metaTitle.title')"
                    :placeholder="$t('posts.add.field.metaTitle.placeholder')"
                    :alert="errors.metaTitle"
                  ></skijasi-text>
                  <skijasi-text
                    v-model="post.metaDescription"
                    size="12"
                    :label="$t('posts.add.field.metaDescription.title')"
                    :placeholder="$t('posts.add.field.metaDescription.placeholder')"
                    :alert="errors.metaTitle"
                  ></skijasi-text>

                </vs-row>
              </skijasi-collapse-item>
            </skijasi-collapse>
          </vs-col>
          <vs-col vs-lg="4" class="pr-0">
            <skijasi-collapse type="margin" class="p-0">
              <skijasi-collapse-item open style="background: #fff; margin-bottom: 30px" class="mt-0">
                <h3 slot="header">{{ $t("posts.add.publish") }}</h3>
                <vs-row class="mb-0">
                  <skijasi-text
                    v-model="post.slug"
                    size="12"
                    :label="$t('posts.add.field.slug.title')"
                    :placeholder="$t('posts.add.field.slug.placeholder')"
                    :alert="errors.slug"
                  ></skijasi-text>
                  <skijasi-switch
                    v-model="post.published"
                    size="12"
                    :label="$t('posts.add.field.published.title')"
                    :placeholder="$t('posts.add.field.published.placeholder')"
                    :alert="errors.published"
                  ></skijasi-switch>
                </vs-row>
              </skijasi-collapse-item>

              <!--
              <skijasi-collapse-item open style="background: #fff; margin-bottom: 30px">
                <h3 slot="header">{{ $t("posts.add.categoryAndTags") }}</h3>
                <vs-row class="mb-0">
                  <skijasi-select
                    v-model="post.category"
                    size="12"
                    :label="$t('posts.add.field.category.title')"
                    :placeholder="$t('posts.add.field.category.placeholder')"
                    :alert="errors.category"
                    :items="categories"
                  ></skijasi-select>
                  <skijasi-select-multiple
                    v-model="post.tags"
                    size="12"
                    :label="$t('posts.add.field.tags.title')"
                    :placeholder="$t('posts.add.field.tags.placeholder')"
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
                    :label="$t('Link na koji vodi vijest')"
                    :placeholder="$t('Link na koji vodi vijest')"
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
                <vs-icon icon="save"></vs-icon> {{ $t("posts.add.button") }}
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
  name: "PostsAdd",
  components: {},
  data: () => ({
    errors: {},
    post: {
      title: "",

      title_en: "",
      title_it: "",
      content_en: "",
      content_it: "",

      slug: "",
      link: "",
      content: "",
      metaTitle: "",
      metaDescription: "",
      summary: "",
      published: true,
      tags: [],
      category: "",
      commentCount: 0,
      thumbnail: ""
    },
    categories: [],
    tags: []
  }),
  mounted() {
    this.getCategory();
    this.getTags();
  },
  methods: {
    syncSlug() {
      let kebab = this.$helper.generateSlug(this.post.title).replaceAll("'", "");
      this.post.slug = kebab
    },
    submitForm() {
      this.errors = {};
      try {
        this.$openLoader();
        this.$api.skijasiPost
          .add(this.post)
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
        console.log(error);
        this.errors = error.data
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
