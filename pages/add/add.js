import request from '../../utils/request'

Page({

  /**
   * 页面的初始数据
   */
  data: {
    index:0,
    CateArray: [],
  },
  //生命周期钩子
  onLoad:function()
  {
    var that = this  //onLoad

    //发送一个get请求 then然后
    request.get('/add.php?action=catelist').then(function(result){
      that.setData({
        CateArray:result
      })
    })
  },
  changeCate(event)
  {
    //修改data里面的index数据
    this.setData({
      index:event.detail.value
    })
  },
  //表单提交方法
  ok(e)
  {
    var data = e.detail.value

    //验证用户名是否为空
    var regu = "^[ ]+$";  //正则表达式
    var re = new RegExp(regu);

    if(re.test(data.username))
    {
      wx.showToast({
        title:'用户名不能为空',
        icon:'none',
        duration:2000
      })
      return false
    }

    //验证个人介绍不能为空
    if(re.test(data.content))
    {
      wx.showToast({
        title:'个人介绍不能为空',
        icon:'none',
        duration:2000
      })
      return false
    }

    //验证手机号码
    if(!(/^1[3456789]\d{9}$/.test(data.phone)))
    {
      wx.showToast({
        title:'手机号码输入有误，请重新填写',
        icon:'none',
        duration:2000
      })
      return false
    }

    var index = this.data.index
    var cateid = this.data.CateArray[index].id

    //组装数据
    var RequestData = {
      'username':data.username,
      'phone':data.phone,
      'content':data.content,
      'cateid':cateid
    }

    //将数据发送给后端插入到数据库
    request.post('/add.php?action=add',RequestData).then(function(res){
      if(res.result)
      {
        //成功
        wx.switchTab({
          url: '/pages/index/index'
        })

      }else{
        //失败
        wx.showToast({
          title:res.msg,
          icon:'none',
          duration:2000
        })
      }
    })
  }

  
})