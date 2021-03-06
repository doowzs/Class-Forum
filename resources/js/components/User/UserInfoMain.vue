<template>
    <div id="UserInfo">
        <div id="UserInfoControl">
            <p class="h3">用户设置</p>
        </div>
        <hr/>
        <div v-if="initializing">
            <div class="row">
                <div class="col text-center mb-3">
                    <div class="spinner spinner-border" role="status"></div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <p>{{ init_status }}</p>
                </div>
            </div>
        </div>
        <div v-else id="UserInfoContent">
            <div class="row">
                <div v-if="canEdit" class="col col-12 mb-2"
                    v-bind:class="isSuperUser ? 'col-md-4' : 'col-md-6'">
                    <button class="btn btn-soft-success w-100"
                            v-on:click="editUserInfo">
                        <i class="fas fa-user-edit mr-2"></i> 修改用户信息
                    </button>
                </div>
                <div v-else class="col col-12 mb-2">
                    <button class="btn btn-soft-info w-100"
                            v-on:click="editUserInfo">
                        <i class="fas fa-user mr-2"></i> 查看用户信息
                    </button>
                </div>
                <user-info-editor-component
                        :id="infoEditorID"
                        :api="api + '/' + user.id"
                        :self="self"
                        :user="user"
                        :isSuperUser="isSuperUser"
                        :isSelf="isSelf"
                        :canEdit="canEdit">
                </user-info-editor-component>

                <div v-if="canEdit" class="col col-12 mb-2"
                     v-bind:class="isSuperUser ? 'col-md-4' : 'col-md-6'">
                    <button class="btn btn-soft-warning w-100"
                            v-on:click="changePassword">
                        <i class="fas fa-key mr-2"></i> 修改登录密码
                    </button>
                    <change-password-component
                            :id="passwordID"
                            :api="api + '/' + user.id"
                            :self="self"
                            :user="user"
                            :isSuperUser="isSuperUser"
                            :isSelf="isSelf"
                    ></change-password-component>
                </div>

                <div v-if="isSuperUser" class="col col-12 col-md-4 mb-2">
                    <button class="btn btn-soft-danger w-100"
                            v-on:click="manageUser">
                        <i class="fas fa-user-cog mr-2"></i> 用户管理选项
                    </button>
                    <user-manage-component
                            :id="manageID"
                            :api="api + '/' + user.id"
                            :self="self"
                            :user="user"
                            :isSuperUser="isSuperUser"
                            :isSelf="isSelf"
                    ></user-manage-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ChangePasswordComponent from "./ChangePasswordComponent";
    import UserInfoEditorComponent from "./UserInfoEditorComponent";
    import UserManageComponent from "./UserManageComponent";
    export default {
        name: "UserInfoMain",
        components: {UserManageComponent, UserInfoEditorComponent, ChangePasswordComponent},
        props: ['user_id'],
        data: function () {
            return {
                initializing: true,
                init_status: '',
                api: '/api/user',
                self: null,
                user: null,
                passwordID: 'ChangePasswordComponent',
                infoEditorID: 'UserInfoEditorComponent',
                manageID: 'UserManageComponent',
            }
        },
        computed: {
            isSuperUser() {
                return this.self.privilege_level <= 1;
            },
            isSelf() {
                return this.self.id === this.user_id;
            },
            canEdit() {
                return this.isSuperUser || this.isSelf;
            }
        },
        created: function () {
            this.getInfo();
        },
        methods: {
            getInfo() {
                this.init_status = '正在检查你的信息...';
                window.axios.get(this.api, {
                    params: {
                        self: 1,
                    }
                }).then(res => {
                    console.debug(res);
                    this.self = res.data;
                }).catch(err => {
                    console.error(err);
                }).finally(() => {
                    this.init_status = '正在获取目标用户...';
                    window.axios.get(this.api + '/' + this.user_id, {
                        // no data
                    }).then(res => {
                        console.debug(res);
                        this.user = res.data;
                    }).catch(err => {
                        console.error(err);
                    }).finally(() => {
                        console.log("User info loaded.");
                        this.initializing = false;
                    });
                })
            },
            changePassword() {
                window.$('#' + this.passwordID).modal('show');
            },
            editUserInfo() {
                window.$('#' + this.infoEditorID).modal('show');
            },
            manageUser() {
                window.$('#' + this.manageID).modal('show');
            },
        }
    }
</script>

<style scoped>

</style>