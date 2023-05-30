<template>
  <div>
    <skijasi-breadcrumb-row> </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('edit_categories')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("category.edit.title") }}</h3>
          </div>
          <vs-row>
            <skijasi-text
              v-model="category.title"
              size="6"
              :label="$t('category.edit.field.title.title')"
              :placeholder="$t('category.edit.field.title.placeholder')"
              :alert="errors.title"
            ></skijasi-text>
            <skijasi-text
              v-model="category.slug"
              size="6"
              :label="$t('category.edit.field.slug.title')"
              :placeholder="$t('category.edit.field.slug.placeholder')"
              :alert="errors.slug"
              disabled
            ></skijasi-text>
            <skijasi-text
              v-model="category.metaTitle"
              size="6"
              :label="$t('category.edit.field.metaTitle.title')"
              :placeholder="$t('category.edit.field.metaTitle.placeholder')"
              :alert="errors.metaTitle"
            ></skijasi-text>
            <skijasi-select
              v-model="category.parentId"
              size="6"
              :label="$t('category.edit.field.parent.title')"
              :placeholder="$t('category.edit.field.parent.placeholder')"
              :alert="errors.parentId"
              :items="categories"
            ></skijasi-select>
            <vs-col vs-lg="12" class="mb-3">
              <skijasi-textarea
                v-model="category.content"
                size="12"
                :label="$t('category.edit.field.content.title')"
                :placeholder="$t('category.edit.field.content.placeholder')"
                :alert="errors.content"
              ></skijasi-textarea>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card class="action-card">
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button color="primary" type="relief" @click="submitForm">
                <vs-icon icon="save"></vs-icon> {{ $t("category.edit.button") }}
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
  name: "CategoryEdit",
  components: {},
  data: () => ({
    errors: {},
    category: {
      title: "",
      parentId: "",
      metaTitle: "",
      slug: "",
      content: "",
    },
    categories: []
  }),
  mounted() {
    this.getCategoryDetail();
  },
  methods: {
    getCategoryDetail() {
      this.$openLoader();
      this.$api.skijasiCategory
        .read({
          id: this.$route.params.id,
          except: true
        })
        .then((response) => {
          this.$closeLoader();
          this.category = response.data.category
          this.categories = response.data.categories.map((category, index) => {
            return {
              label: category.title,
              value: category.id
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
    },
    submitForm() {
      this.errors = {};
      try {
        this.$openLoader();
        this.$api.skijasiCategory
          .edit(this.category)
          .then((response) => {
            this.$closeLoader();
            this.$router.push({ name: "CategoryBrowse" });
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
